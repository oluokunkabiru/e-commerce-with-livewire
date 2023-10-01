<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Property;
use App\Models\Size;
use App\Models\State;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $minPrice = 0;
    public $maxPrice = 0;
    public $moreAttr;
    public $perPage = 10;

    public $features = [];
    public $sizes  = [];

    public $sort  = 'latest';
    public $feature = [];
    public $size  = [];
    public $products = [];
    public $country;
    public $countries=[];


    public $state;
    public $states = [];

    public $city;
    public $cities = [];

    public $categories =[];
    public $category;


    protected $queryString = [
        'sort'  => ['except' => 'latest'],
        'feature' => ['except' => []],
        'size'  => ['except' => []],
    ];

    public function dehydrate()
    {
        $this->emit('observeImage');
    }

    public function updatedSort()
    {
        $this->emit('resetPriceRange');
        $this->updateFilteredProperties();

    }

    public function updatedFeature()
    {
        $this->emit('resetPriceRange');
        $this->updateFilteredProperties();

    }

    public function updatedSize()
    {

        $this->emit('resetPriceRange');
        $this->updateFilteredProperties();

    }



    public function updatedCountry($newCountry)
    {
        $this->states = State::where('country_id', $newCountry)->get();
        $this->state = null; // Reset selected state
        $this->city = null; // Reset selected city

        // Update properties based on the selected filters
        $this->updateFilteredProperties();
    }

    public function updatedState($newState)
    {
        $this->cities = City::where('state_id', $newState)->get();
        $this->city = null; // Reset selected city
    }

    public function updateCategory($newCategory)
    {
        $this->updateFilteredProperties();

    }



    public function updateFilteredProperties()
    {
        $this->category = ModelsCategory::where('slug', $this->category)->with('subCategories')->firstOrFail();
        // $category = ModelsCategory::where('slug', $slug)->with('subCategories')->firstOrFail();
        $this->categories = ModelsCategory::where('status', 1)->get();
        $this->countries = Country::get();

        $this->products = Property::where('category_id', $this->category->id)




        ->with('onSaleAttributes', function ($query) {
            if ($this->minPrice > 0) {
                $query->where('price', '>=', $this->minPrice);
            }

            if ($this->maxPrice > 0) {
                $query->where('price', '<=', $this->maxPrice);
            }

            if (count($this->feature) > 0) {
                $query->whereIn('feature_id', $this->feature);
            }

            if (count($this->size) > 0) {
                $query->whereIn('size_id', $this->size);
            }

        })->whereHas('onSaleAttributes', function ($query) {
            if ($this->minPrice > 0) {
                $query->where('price', '>=', $this->minPrice);
            }

            if ($this->maxPrice > 0) {
                $query->where('price', '<=', $this->maxPrice);
            }

            if (count($this->feature) > 0) {
                $query->whereIn('feature_id', $this->feature);
            }

            if (count($this->size) > 0) {
                $query->whereIn('size_id', $this->size);
            }

        })->withCount('onSaleAttributes')
        ->when($this->sort=='oldest', function($old){
            $old->oldest();
        })


        ->when($this->sort=='a-z', function($old){
            $old->orderBy('name', 'asc');
        })
        ->when($this->sort=='z-a', function($old){
            $old->orderBy('name', 'desc');
        })



         // ->paginate($this->perPage)

         ->get()

         ;

    }

    public function mount($slug)
    {
        $this->category = ModelsCategory::where('slug', $slug)->with('subCategories')->firstOrFail();
        // $category = ModelsCategory::where('slug', $slug)->with('subCategories')->firstOrFail();
        $this->categories = ModelsCategory::where('status', 1)->get();
        $this->countries = Country::get();

        $this->products = Property::where('category_id', $this->category->id)




        ->with('onSaleAttributes', function ($query) {
            if ($this->minPrice > 0) {
                $query->where('price', '>=', $this->minPrice);
            }

            if ($this->maxPrice > 0) {
                $query->where('price', '<=', $this->maxPrice);
            }

            if (count($this->feature) > 0) {
                $query->whereIn('feature_id', $this->feature);
            }

            if (count($this->size) > 0) {
                $query->whereIn('size_id', $this->size);
            }

        })->whereHas('onSaleAttributes', function ($query) {
            if ($this->minPrice > 0) {
                $query->where('price', '>=', $this->minPrice);
            }

            if ($this->maxPrice > 0) {
                $query->where('price', '<=', $this->maxPrice);
            }

            if (count($this->feature) > 0) {
                $query->whereIn('feature_id', $this->feature);
            }

            if (count($this->size) > 0) {
                $query->whereIn('size_id', $this->size);
            }

        })->withCount('onSaleAttributes')
        ->when($this->sort=='oldest', function($old){
            $old->oldest();
        })


        ->when($this->sort=='a-z', function($old){
            $old->orderBy('name', 'asc');
        })
        ->when($this->sort=='z-a', function($old){
            $old->orderBy('name', 'desc');
        })



         // ->paginate($this->perPage)

         ->get()

         ;


        //  $this->minPrice = Property::min('price');
        //  info($this->minPrice);
        //  $this->maxPrice = Property::maxx('price');
        //  info($this->maxPrice);

        // ->paginate($this->perPage)
        // ;

        // if ('oldest' == $this->sort) {
        //     $qry->oldest();
        // } elseif ('a-z' == $this->sort) {
        //     $qry->orderBy('name', 'asc');
        // } elseif ('z-a' == $this->sort) {
        //     $qry->orderBy('name', 'desc');
        // } else {
        //     $qry->latest();
        // }

        // $products = $qry->paginate($this->perPage);

        $allProducts = Property::where('category_id', $this->category->id)->has('onSaleAttributes')->get();

        $this->minPrice = $allProducts->first()->onSaleAttributes->min('price');
        $this->maxPrice = $allProducts->first()->onSaleAttributes->max('price');

        // $this->features = Feature::get();
        // $this->sizes = Size::get();



        foreach ($allProducts as $product) {
            $this->minPrice = $this->minPrice > $product->onSaleAttributes->min('price')
            ? $product->onSaleAttributes->min('price')
            : $this->minPrice;

            $this->maxPrice = $this->maxPrice < $product->onSaleAttributes->max('price')
            ? $product->onSaleAttributes->max('price')
            : $this->maxPrice;

            foreach ($product->onSaleAttributes as $key => $attr) {
                $this->features[$key] = $attr->feature;
                $this->sizes[$key]  = $attr->size;
            }
        }






    }





    public function render()
    {


        return view('livewire.category')
            ->extends('layouts.app')
            ->section('contents');
    }
}
