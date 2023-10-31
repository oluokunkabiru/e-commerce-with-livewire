<?php

namespace App\Http\Livewire\Child;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\PropertyDetail;
use App\Models\User;
use App\Notifications\OrderPlaced;
use Cartalyst\Stripe\Exception\BadRequestException;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\InvalidRequestException;
use Cartalyst\Stripe\Exception\NotFoundException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CheckoutForm extends Component
{
    public $name, $email, $mobile, $zip, $address, $city, $state, $company, $password;

    protected $listeners = ["submit"];


    // protected $rules = [

    //     'name' => 'required|min:6',

    //     'email' => 'required|email',

    // ];


    public function rules()
    {
        return
        [
            'name'     => "required|string",
            'email'    => "required|email",
            'mobile'   => "required|string",
            'zip'      => "required|numeric",
            'address'  => "required|string",
            'city'     => "required|string",
            "state"    => "required|string",
            "company"  => "nullable|string",
            "password" => Rule::requiredIf(!auth()->check()),
        ];
    }

    public function submit()
    {
        // dd($token);
        $validatedData = $this->validate();

        $credentials = [
            'email'    => $this->email,
            'password' => $this->password,
        ];
        $newUser = $validatedData;

        $uid = null;
        if (!auth()->check()) {
            $uid = cache('user_temp_id', 0);
        }
        if (!auth()->check() || !auth()->user()->email_verified_at) {
            $this->guestCheckout($newUser, $credentials);
        }

        if (auth()->check()) {
            $carts = Cart::where('user_id', $uid ?? userId())->get();

            $coupon = session('appliedCoupon');

            unset($validatedData['password']);

            if ($uid) {
                $orderStatus = "waiting";
            } else {
                if (auth()->user()->email_verified_at) {
                    $orderStatus = "pending";
                } else {
                    $orderStatus = "waiting";
                }
            }

            $final = finalPrice($uid);

            $validatedData['user_id']        = auth()->id();
            $validatedData['total_price']    = cartTotal($uid)['total'];
            $validatedData['coupon']         = $coupon ? $coupon->code : null;
            $validatedData['tax']            = $final['tax'];
            $validatedData['final_price']    = $final['total'];
            $validatedData['payment_status'] = 'pending';
            $validatedData['order_status']   = $orderStatus;

            $order = Order::create($validatedData);

            $message = null;

         
                Order::find($order->id)->update([
                    'payment_status' => 'pending',
                    'payment_type'   => 'Awaiting',
                ]);
           

            session()->flash('card_error', $message);

            foreach ($carts as $cart) {
                OrderDetail::create([
                    'order_id'        => $order->id,
                    'property_id'      => $cart->property_id,
                    'property_attr_id' => $cart->property_attr_id,
                    'qty'             => $cart->qty,
                ]);
                $pd = PropertyDetail::find($cart->property_attr_id);
                $pd->update(['qty' => $pd->qty - $cart->qty]);
                $cart->delete();
            }

            if (session()->has("appliedCoupon")) {
                $coupon = session("appliedCoupon");
                $coupon->update(["used" => $coupon->used + 1]);
            }

            session()->forget('appliedCoupon');
            session()->forget('appliedCouponCode');
            session()->forget('appliedCouponExtra');

            if (auth()->user()->email_verified_at) {
                $data = ["name" => auth()->user()->name, "link" => route("order.detail", $order->id)];

                Notification::send(auth()->user(), new OrderPlaced($data));
            }

            session()->flash('order_placed', 'We have received your request successfully.');
            return redirect()->route('order.detail', $order->id);
        } else {
            session()->flash('error_msg', 'Please enter valid login information.');
        }
    }

    public function guestCheckout(array $newUser, array $credentials)
    {
        $user = User::where("email", $newUser["email"])->first();

        if (!$user) {
            $this->prepareUser(null, $newUser);
        } elseif (!$user->email_verified_at) {
            $this->prepareUser($user);
        }

        Auth::attempt($credentials, true);
    }

    public function prepareUser($user = null, array $newUser = [])
    {
        $hash = str_shuffle('absdkmfnejfmkedmsmf109948394344usdnfjenejm');

        $newUser['verification_code'] = $hash;
        $newUser['password'] = Hash::make($newUser['password']);

        if ($user) {
            $user->update(["verification_code" => $hash]);
        } else {
            $user = User::create($newUser);
        }

        $data = [
            'name' => $user->name,
            'link' => route('verify', $newUser['verification_code']),
        ];
        sendVerificationEmail($data, $user);
    }

    public function mount()
    {
        if (auth()->check()) {
            $this->name     = auth()->user()->name;
            $this->email    = auth()->user()->email;
            $this->mobile   = auth()->user()->mobile;
            $this->zip      = auth()->user()->zip;
            $this->address  = auth()->user()->address;
            $this->city     = auth()->user()->city;
            $this->state    = auth()->user()->state;
            $this->company = auth()->user()->company;
        }
    }

    public function render()
    {
        return view('livewire.child.checkout-form');
    }
}
