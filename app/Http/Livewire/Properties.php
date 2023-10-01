<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Property;
use App\Models\State;
use Livewire\Component;

class Properties extends Component
{


    public $country;
    public $countries=[];


    public $state;
    public $states = [];

    public $city;
    public $cities = [];

    public $category;
    public $categories =[];

    public $bestSellers;
    public $featureds;

    public $trendings;
    public $discounteds;


    public function updatedCount($newCountry)
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
        info(['category'=>$this->category]);

        $this->updateFilteredProperties();
    }

    public function updateFilteredProperties()
    {

        $this->countries = Country::get();

        $this->categories = Category::withCount('products')
            ->when($this->category, function ($cat){
                return $cat->where('id', $this->category);
            })
            ->has('products')
            ->where('status', 1)
            ->where('in_home_page', 1)
            ->orderBy('products_count', 'desc')
            ->get();



    }




    public function mount(){
        $this->countries = Country::get();
        $this->categories = Category::withCount('products')
            ->when($this->category, function ($cat){
                return $cat->where('id', $this->category);
            })
            ->has('products')
            ->where('status', 1)
            ->where('in_home_page', 1)
            // ->whereHas('photo')
            ->orderBy('products_count', 'desc')
            ->get();


    }


    public function render()
    {
        return view('livewire.properties')
        ->extends('layouts.app')
        ->section('contents');;
    }
}
