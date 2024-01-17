<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Property;
use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;

class Properties extends Component
{


    // use WithPagination;

    // public $minPrice = 0;
    // public $maxPrice = 0;
    // public $moreAttr;
    // public $perPage = 10;

    // public $features = [];
    // public $sizes  = [];

    // public $sort  = 'latest';
    // public $feature = [];
    // public $size  = [];
    // public $country;
    // public $countries=[];


    // public $state;
    // public $states = [];

    // public $city;
    // public $cities = [];

    // public $categories =[];
    // public $category;
    // public $properties;

    // public $products = [];
   


    // protected $queryString = [
    //     'sort'  => ['except' => 'latest'],
    //     'feature' => ['except' => []],
    //     'size'  => ['except' => []],
    // ];

    // public function dehydrate()
    // {
    //     $this->emit('observeImage');
    // }

    // public function updatedSort()
    // {
    //     $this->emit('resetPriceRange');
    // }

    // public function updatedFeature()
    // {
    //     $this->emit('resetPriceRange');
    // }

    // public function updatedSize()
    // {
    //     $this->emit('resetPriceRange');
    // }


    // public function updatedCountry($newCountry)
    // {
    //     $this->states = State::where('country_id', $newCountry)->get();
    //     $this->state = null; // Reset selected state
    //     $this->city = null; // Reset selected city
    //     $this->updateFilteredProperties();
    // }

    // public function updatedState($newState)
    // {
    //     $this->cities = City::where('state_id', $newState)->get();
    //     $this->city = null; // Reset selected city
    //     $this->updateFilteredProperties();
    // }

    // public function updateCategory($newCategory)
    // {
    //     $this->category = $newCategory;
    //     $this->updateFilteredProperties();
    // }

    // public function updateFilteredProperties()
    // {
    //     $this->bestSellers = Property::with('onSaleAttributes')
    //         ->has('onSaleAttributes')
    //         ->where('best_seller', 1)
    //         ->where('status', 1)
    //         ->when($this->country, function ($query) {
    //             $query->where('country_id', $this->country);
    //         })
    //         ->when($this->state, function ($query) {
    //             $query->where('state_id', $this->state);
    //         })
    //         ->when($this->category, function ($query) {
    //             $query->where('category_id', $this->category);
    //         })
    //         ->latest()
    //         ->get();

    //     $this->featureds = Property::with('onSaleAttributes')
    //         ->has('onSaleAttributes')
    //         ->where('featured', 1)
    //         ->where('status', 1)
    //         ->when($this->country, function ($query) {
    //             $query->where('country_id', $this->country);
    //         })
    //         ->when($this->state, function ($query) {
    //             $query->where('state_id', $this->state);
    //         })
    //         ->when($this->category, function ($query) {
    //             $query->where('category_id', $this->category);
    //         })
    //         ->latest()
    //         ->get();

    //     $this->trendings = Property::with('onSaleAttributes')
    //         ->has('onSaleAttributes')
    //         ->where('trending', 1)
    //         ->where('status', 1)
    //         ->when($this->country, function ($query) {
    //             $query->where('country_id', $this->country);
    //         })
    //         ->when($this->state, function ($query) {
    //             $query->where('state_id', $this->state);
    //         })
    //         ->when($this->category, function ($query) {
    //             $query->where('category_id', $this->category);
    //         })
    //         ->latest()
    //         ->get();

    //     $this->discounteds = Property::with('onSaleAttributes')
    //         ->has('onSaleAttributes')
    //         ->where('discounted', 1)
    //         ->where('status', 1)
    //         ->when($this->country, function ($query) {
    //             $query->where('country_id', $this->country);
    //         })
    //         ->when($this->state, function ($query) {
    //             $query->where('state_id', $this->state);
    //         })
    //         ->when($this->category, function ($query) {
    //             $query->where('category_id', $this->category);
    //         })
    //         ->latest()
    //         ->get();
    //     // Note: Make sure your property model has relationships defined for country, state, and category.
    // }




    public function mount(){

        // $this->country =Country()->id;
        // // $this->states = State::where('country_id', $this->country)->get();


        
        // $this->countries = Country::get();
        // $this->categories = Category::withCount('products')
        //     ->when($this->category, function ($cat){
        //         return $cat->where('id', $this->category);
        //     })
        //     ->has('products')
        //     ->where('status', 1)
        //     // ->where('in_home_page', 1)
        //     ->where('in_home_page', '!=', 1)

        //     // ->whereHas('photo')
        //     ->orderBy('products_count', 'desc')
        //     ->get();





    // $this->properties = Property::with('onSaleAttributes')
    // ->has('onSaleAttributes')
    // ->where('status', 1)
    // ->when($this->country, function ($query) {
    //     $query->where('country_id', $this->country);
    // })
    // ->latest()->get();


       
    }


    public function render()
    {
        return view('livewire.properties')
        ->extends('layouts.app')
        ->section('contents');;
    }
}
