<?php

namespace App\Http\Livewire\Admin\Property;

use App\Http\Controllers\MediaController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\Size;
use App\Models\State;
use App\Models\Tax;
use App\Rules\NotNull;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataEntry extends Component
{
    use WithFileUploads;

    public $that   = 'property';
    public $thatUp = 'Property';
    public $editId = '';

    public $category;
    public $brand;
    public $name;
    public $slug;
    public $model;
    public $short_description;
    public $description;
    public $keywords;
    public $technical_specification;
    public $usage;
    public $warrenty;


    public $lead_time;
    public $tax;
    public $promo;
    public $featured;
    public $discounted;
    public $trending;
    public $best_seller;

    public $attributes = [];

    public $property;

    public $categories;
    public $taxes;
    public $brands;
    public $sizesDt;
    public $featuresDt;

    public $photos   = [];
    public $newPhoto = [];

    public $previousPhoto = [];
    public $hasAttr       = false;



    public $country;
    public $countries;

    public $state;
    public $states=[];

    public $city;
    public $cities=[];

    protected $listeners = ['removeAttr'];

    protected function rules()
    {
        return '' != $this->editId ? [
            'name'                => ['required', Rule::unique('properties')->ignore($this->editId)],
            'slug'                => ['required', Rule::unique('properties')->ignore($this->editId)],
            'category'            => ['required', 'integer'],
            'state'               => ['required', 'integer'],
            'country'               => ['required', 'integer'],
            'city'               => ['required', 'integer'],
            'short_description'   => 'required',
            'description'         => 'required',
            'keywords'            => 'required',
            // 'warrenty'         => 'required',
            'promo'               => ['required', Rule::in([0, 1])],
            'featured'            => ['required', Rule::in([0, 1])],
            'discounted'          => ['required', Rule::in([0, 1])],
            'trending'            => ['required', Rule::in([0, 1])],
            'best_seller'         => ['required', Rule::in([0, 1])],

            'attributes.*.feature'  => ['required', new NotNull],
            'attributes.*.size'   => ['required', new NotNull],
            'attributes.*.price'  => ['required', new NotNull, 'integer'],
            'attributes.*.qty'    => ['required', new NotNull, 'integer'],
            'attributes.*.status' => [Rule::in([1, 0])],
            'attributes.*.photo'  => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (method_exists($value, 'getMimeType')) {
                        if (!in_array($value->getMimeType(), ["image/jpeg", "image/png", "image/jpg"])) {
                            return $fail('The ' . $attribute . ' must be a file of type: jpeg, jpg, png.');
                        }
                    } else if (gettype($value) != 'string') {
                        return $fail('The ' . $attribute . ' is invalid.');
                    }
                },
            ],
        ]
        : [
            'name'                => 'required|unique:properties',
            'slug'                => 'required|unique:properties',
            'category'            => ['required', 'integer'],
            'state'               => ['required', 'integer'],
            'country'               => ['required', 'integer'],
            'city'               => ['required', 'integer'],
            'short_description'   => 'required',
            'description'         => 'required',
            // 'warrenty'         => 'required',
            'keywords'            => 'required',
            'promo'               => ['required', Rule::in([0, 1])],
            'featured'            => ['required', Rule::in([0, 1])],
            'discounted'          => ['required', Rule::in([0, 1])],
            'trending'            => ['required', Rule::in([0, 1])],
            'best_seller'         => ['required', Rule::in([0, 1])],
            'attributes.*.feature'  => ['required', new NotNull],
            'attributes.*.size'   => ['required', new NotNull],
            'attributes.*.price'  => ['required', new NotNull, 'integer'],
            'attributes.*.qty'    => ['required', new NotNull, 'integer'],
            'attributes.*.status' => [Rule::in([1, 0])],
            'attributes.*.photo'  => 'image|mimes:jpeg,jpg,png',
        ];
    }

    public function validatePhoto()
    {
        $this->validate(['attributes.*.photo' => [
            'nullable',
            function ($attribute, $value, $fail) {
                if (method_exists($value, 'getMimeType')) {
                    if (!in_array($value->getMimeType(), ["image/jpeg", "image/png", "image/jpg"])) {
                        return $fail('The ' . $attribute . ' must be a file of type: jpeg, jpg, png.');
                    }
                } else if (gettype($value) != 'string') {
                    return $fail('The ' . $attribute . ' is invalid.');
                }
            },
        ]]);
    }

    public function dehydrate()
    {
        $this->emit('setEditor');
    }

    public function hydrate()
    {
        $this->hasAttr = count($this->attributes) > 0 ? true : false;
    }

    public function updatedNewPhoto()
    {
        $index = array_key_last($this->newPhoto);
        if ($this->attributes[$index]) {
            $this->attributes[$index]['photo'] = $this->newPhoto[$index];
            $this->attributes[$index]['src']   = $this->newPhoto[$index]->temporaryUrl();
        }

        $this->newPhoto = [];
        $this->validatePhoto();
    }

    public function updatedPhotos()
    {
        $i   = count($this->attributes);
        $end = $i + count($this->photos);

        for ($i = $i, $j = 0; $i < $end, $j < count($this->photos); $i++, $j++) {
            $this->attributes[$i] = [
                'photo'     => $this->photos[$j],
                'src'       => $this->photos[$j]->temporaryUrl(),
                'feature'     => '',
                'size'      => '',
                'price'     => '',
                'qty'       => '',
                'order_id'  => '',
                'status'    => 1,
                'new_photo' => '',
                'id'        => '',
            ];
        }
        $this->photos = [];
        $this->validatePhoto();
    }


            public function updatedCountry($newCountry)
        {
            // Fetch states based on the selected country and update the $states property
            $this->states = State::where('country_id', $newCountry)->get();
            // Reset the selected state and city
            $this->state = null;
            $this->city = null;
        }


       

        public function updatedState($newState)
        {
            // Fetch cities based on the selected state and update the $cities property
            $this->cities = City::where('state_id', $newState)->get();
            // Reset the selected city
            $this->city = null;
        }

    public function removeAttr($index)
    {
        if ('' != $this->attributes[$index]['id']) {
            $data = PropertyDetail::find($this->attributes[$index]['id']);
            if ($data) {
                Storage::delete('public/product_image/' . $data->photos);
                $data->forceDelete();
            }
        }

        array_splice($this->attributes, $index, 1);
        $this->validatePhoto();
    }

    public function resortAttr($keys)
    {
        $resort = array_column($keys, 'value');
        array_multisort($resort, SORT_ASC, $this->attributes);
        $this->validatePhoto();
    }

    public function submit()
    {

        $this->slug = '' != $this->slug ? Str::slug($this->slug) : Str::slug($this->name);

        $this->promo       = 'true' == $this->promo ? 1 : 0;
        $this->featured    = 'true' == $this->featured ? 1 : 0;
        $this->discounted  = 'true' == $this->discounted ? 1 : 0;
        $this->trending    = 'true' == $this->trending ? 1 : 0;
        $this->best_seller = 'true' == $this->best_seller ? 1 : 0;

        $this->validate();

        $form = [
            'name'                    => $this->name,
            'slug'                    => $this->slug,
            'category_id'             => $this->category,
            'country_id'                => $this->country,
            'state_id'                => $this->state,
            'city_id'                => $this->city,
            'short_description'       => $this->short_description,
            'description'             => $this->description,
            'keywords'                => $this->keywords,
            'warrenty'                => $this->warrenty,
            // 'lead_time'               => $this->lead_time,
            // 'tax_id'                  => $this->tax,
            'promo'                   => $this->promo,
            'featured'                => $this->featured,
            'discounted'              => $this->discounted,
            'trending'                => $this->trending,
            'best_seller'             => $this->best_seller,
        ];


        Log::info($form);
        $status = "added";

        if ($this->editId !='' && $this->property && can('edit property')) {
            $this->property->update($form);

            foreach ($this->attributes as $key => $attribute) {
                if ($attribute['id']!='') {

                    $PropertyDetailUpdate = PropertyDetail::where('property_id', $this->editId)->where('id', $attribute['id'])->first();

                    if ($attribute['photo'] && method_exists($attribute['photo'], 'storeAs')) {
                        $PropertyDetailUpdate->clearMediaCollection('products');
                        $PropertyDetailUpdate->addMedia($attribute['photo'])
                        ->toMediaCollection('products');
                    }

                    if ($PropertyDetailUpdate) {
                        $PropertyDetailUpdate->update([
                            'price'    => $attribute['price'],
                            'qty'      => $attribute['qty'],
                            'size_id'  => $attribute['size'],
                            'feature_id' => $attribute['feature'],
                            'status'   => $attribute['status'],
                            'order_id' => $key + 1,
                        ]);
                    }
                } else {
                    PropertyDetail::where('property_id', $this->editId)->first();
                    // ->addMedia($attribute['photo'])
                    // ->toMediaCollection('products');
                    $this->storeDetail($this->editId, $attribute, $key);
                    // $media = MediaController::set(PropertyDetail::class, $attribute['photo'], 'products', $this->product->slug . '__' . $key);
                    // $media??$media->upload($id);
                }
            }

            $status = "updated";
        } else {
            if (can('add property')) {
                $property = Property::create($form);
            }

            if ($this->hasAttr) {
                foreach ($this->attributes as $key => $attribute) {
                    // $media = MediaController::set(PropertyDetail::class, $attribute['photo'], 'products', $product->slug . '__' . $key);

                    $this->storeDetail($property->id, $attribute, $key);
                    // $media??$media->upload($id);

                    // PropertyDetail::addMedia($attribute['photo'])
                    // ->toMediaCollection('products');

                }
            }
        }

        session()->flash('success_msg', $this->thatUp . ' ' . $status);
        return redirect()->route('dashboard.' . $this->that);
    }

    public function storeDetail($pid, $attribute, $key)
    {
        if (can('add property')) {
            $pro = PropertyDetail::create([
                'price'      => $attribute['price'],
                'qty'        => $attribute['qty'],
                'size_id'    => $attribute['size'],
                'feature_id'   => $attribute['feature'],
                'property_id' => $pid,
                'order_id'   => $key + 1,
                'status'     => $attribute['status'],
            ])->addMedia($attribute['photo'])
            ->toMediaCollection('products');

            return $pro->id;
        }
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->property                 = Property::where('id', $id)->with('PropertyDetails')->firstOrFail();
            $this->name                    = $this->property->name;
            $this->slug                    = $this->property->slug;
            $this->category                = $this->property->category_id;
            $this->country                   = $this->property->country_id;
            $this->city                   = $this->property->city_id;
            $this->state                   = $this->property->state_id;
            $this->short_description       = $this->property->short_description;
            $this->description             = $this->property->description;
            $this->keywords                = $this->property->keywords;
            $this->description             = $this->property->description;
            $this->warrenty                = $this->property->warrenty;
            $this->editId                  = $this->property->id;
            $this->promo       = $this->property->promo;
            $this->featured    = $this->property->featured;
            $this->discounted  = $this->property->discounted;
            $this->trending    = $this->property->trending;
            $this->best_seller = $this->property->best_seller;

            if ($this->property->PropertyDetails->count() > 0) {

                foreach ($this->property->PropertyDetails as $key => $PropertyDetailDt) {
                    $this->attributes[$key] = [
                        'photo'     => $PropertyDetailDt->photos,
                        'src'       => $PropertyDetailDt->getMedia('products')->first()!=null ? $PropertyDetailDt->getMedia('products')->first()->getFullUrl():null,
                        'feature'     => $PropertyDetailDt->feature_id,
                        'size'      => $PropertyDetailDt->size_id,
                        'price'     => $PropertyDetailDt->price,
                        'qty'       => $PropertyDetailDt->qty,
                        'order_id'  => $PropertyDetailDt->order_id,
                        'status'    => $PropertyDetailDt->status,
                        'new_photo' => '',
                        'id'        => $PropertyDetailDt->id,
                    ];
                }
            }
        }
    }

    public function render()
    {
        $this->promo       = 1 == $this->promo ? true : false;
        $this->featured    = 1 == $this->featured ? true : false;
        $this->discounted  = 1 == $this->discounted ? true : false;
        $this->trending    = 1 == $this->trending ? true : false;
        $this->best_seller = 1 == $this->best_seller ? true : false;

        $this->hasAttr = count($this->attributes) > 0 ? true : false;

        $this->categories = Category::where('status', 1)->get(['name', 'id'])->toArray();
        $this->countries = Country::get();
        $this->states = $this->states;
        $this->cities = $this->cities;
        // $this->taxes      = Tax::where('status', 1)->get(['id', 'description'])->toArray();
        // $this->brands     = Brand::where('status', 1)->get(['name', 'id'])->toArray();

        $this->sizesDt  = $this->hasAttr ? Size::where('status', 1)->get()->toArray() : [];
        $this->featuresDt = $this->hasAttr ? Feature::where('status', 1)->get()->toArray() : [];

        return view('livewire.admin.property.data-entry')
            ->layout('layouts.admin');
    }
}
