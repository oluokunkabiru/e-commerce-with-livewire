<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;

class Home extends Component
{
    public $country;
    public $countries=[];


    public $state;
    public $states = [];

    public $city;
    public $cities = [];

    public $categories =[];
    public $category;
    public $bestSellers;
    public $featureds;
    public $trendings;
    public $discounteds;




    public function updatedCountry($newCountry)
    {
        $this->states = State::where('country_id', $newCountry)->get();
        $this->state = null; // Reset selected state
        $this->city = null; // Reset selected city
        $this->updateFilteredProperties();
    }

    public function updatedState($newState)
    {
        $this->cities = City::where('state_id', $newState)->get();
        $this->city = null; // Reset selected city
        $this->updateFilteredProperties();
    }

    public function updateCategory($newCategory)
    {
        $this->category = $newCategory;
        $this->updateFilteredProperties();
    }

    public function updateFilteredProperties()
    {
        $this->bestSellers = Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('status', 1)
            ->when($this->country, function ($query) {
                $query->where('country_id', $this->country);
            })
            ->when($this->state, function ($query) {
                $query->where('state_id', $this->state);
            })
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->latest()
            ->get();

        $this->featureds = Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('status', 1)
            ->when($this->country, function ($query) {
                $query->where('country_id', $this->country);
            })
            ->when($this->state, function ($query) {
                $query->where('state_id', $this->state);
            })
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->latest()
            ->get();

        $this->trendings = Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('status', 1)
            ->when($this->country, function ($query) {
                $query->where('country_id', $this->country);
            })
            ->when($this->state, function ($query) {
                $query->where('state_id', $this->state);
            })
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->latest()
            ->get();

        $this->discounteds = Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('discounted', 1)
            ->where('status', 1)
            ->when($this->country, function ($query) {
                $query->where('country_id', $this->country);
            })
            ->when($this->state, function ($query) {
                $query->where('state_id', $this->state);
            })
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->latest()
            ->get();
        // Note: Make sure your property model has relationships defined for country, state, and category.
    }


public function mount(){

    // $ip = request()->ip();
    // $location= Location::get($ip);

// info(['rate'=>Currency()]);

// info(['country'=>$this->country]);

$this->country =Country()->id;


    $this->bestSellers = Property::with('onSaleAttributes')
        ->has('onSaleAttributes')
        ->where('best_seller', 1)
        ->when($this->country, function ($query) {
            $query->where('country_id', $this->country);
        })
        ->where('status', 1)
        ->latest()->get();

    $this->featureds = Property::with('onSaleAttributes')
        ->has('onSaleAttributes')
        ->where('featured', 1)
        ->when($this->country, function ($query) {
            $query->where('country_id', $this->country);
        })
        ->where('status', 1)
        ->latest()->get();

    $this->trendings = Property::with('onSaleAttributes')
        ->has('onSaleAttributes')
        ->where('trending', 1)
        ->where('status', 1)
        ->when($this->country, function ($query) {
            $query->where('country_id', $this->country);
        })
        ->latest()->get();

    $this->discounteds = Property::with('onSaleAttributes')
        ->has('onSaleAttributes')
        ->where('discounted', 1)
        ->where('status', 1)
        ->when($this->country, function ($query) {
            $query->where('country_id', $this->country);
        })
        ->latest()->get();

    $this->categories = Category::where('status', 1)
    ->where('in_home_page', '!=', 1)
    ->get();
    $this->countries = Country::get();
    $this->states = State::where('country_id', $this->country)->get();




}

    public function render()
    {


        return view('livewire.home')
            ->extends('layouts.app')
            ->section('contents');
    }
}
