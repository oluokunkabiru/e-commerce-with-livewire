<?php

namespace App\Http\Livewire\Child;

use App\Models\Cart;
use App\Models\PropertyDetail;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetailPartial extends Component
{
    public $product;
    public $attribute;
    public $attributeArr;
    public $qty  = 1;
    public $rate = 0;

    protected $queryString = [
        'attribute' => ['except' => ''],
    ];

    public function dehydrate()
    {
        $this->emit('observeImage');
    }

    public function attribute($id)
    {
        $this->attributeArr = PropertyDetail::where('property_id', $this->product->id)
            ->with(['maxRate', 'photo'])
            ->where('id', $id)
            ->where('qty', '>', 0)
            ->where('status', 1)
            ->first();

        $this->attribute = $this->attributeArr->id;
        if ($this->attributeArr->maxRate->count() > 0) {
            $this->rate = $this->attributeArr->maxRate[0]->max_rate;
        }
        $this->emitUp('changeAttr', $this->attribute);
    }

    public function addToCart($pid = '', $aid = '', $qty = '')
    {
        $isEmit = '' != $pid ? false : true;
        $pid    = '' != $pid ? $pid : $this->product->id;
        $aid    = '' != $aid ? $aid : $this->attribute;
        $qty    = '' != $qty ? $qty : $this->qty;

        $registered = 1;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            if (cache()->has('user_temp_id')) {
                $user_id = cache('user_temp_id');
            } else {
                $user_id = rand(111111111, 9999999999);
                cache()->put('user_temp_id', $user_id, now()->addDays(30));
            }
            $registered = 0;
        }

        $preCart = Cart::where('user_id', $user_id)
            ->where('property_id', $pid)
            ->where('property_attr_id', $aid)
            ->first();

        $pQty = PropertyDetail::where('id', $aid)->get('qty')->first()->qty;
        if ($pQty < $qty) {
            session()->flash('product_error_msg', 'Quantity should be less that or equal to ' . $pQty . '.');
            return;
        } else if ($qty < 1) {
            session()->flash('product_error_msg', 'Quantity should be greater that 0.');
            return;
        }

        if ($preCart) {
            $preCart->update(['qty' => $qty]);
            session()->flash('product_success_msg', 'Contact List quantity updated.');
        } else {
            Cart::create([
                'user_id'         => $user_id,
                'registered'      => $registered,
                'qty'             => $qty,
                'property_id'      => $pid,
                'property_attr_id' => $aid,
            ]);
            session()->flash('product_success_msg', 'Property added to contact list.');
            if ($isEmit) {
                $this->emit('cartUpdated');
            }

        }
    }

    public function addTowishlist($pid = '', $aid = '')
    {
        $pid = '' != $pid ? $pid : $this->product->id;
        $aid = '' != $aid ? $aid : $this->attribute;

        if (auth()->check()) {
            $wishlist = Wishlist::where('user_id', auth()->user()->id)
                ->where('property_id', $pid)
                ->where('property_attr_id', $aid)->first();

            if (!$wishlist) {
                Wishlist::create([
                    'user_id'         => auth()->user()->id,
                    'property_id'      => $pid,
                    'property_attr_id' => $aid,
                ]);
                session()->flash('product_success_msg', 'Property added to wishlist.');
            } else {
                session()->flash('product_success_msg', 'Property already in wishlist.');
            }
        } else {
            session()->flash('product_error_msg', 'Please login to add property in wishlist.');
        }
    }

    public function mount()
    {
        if ('' != $this->attribute) {
            $this->attribute($this->attribute);
        } else {
            $this->attributeArr = $this->product->details->first();
            $this->attribute    = $this->attributeArr->id;
        }
    }

    public function render()
    {
        return view('livewire.child.product-detail-partial');
    }
}
