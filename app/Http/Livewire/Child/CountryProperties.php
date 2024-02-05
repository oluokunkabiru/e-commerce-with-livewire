<?php

namespace App\Http\Livewire\Child;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Property;
use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;

class CountryProperties extends Component
{


    use WithPagination;

    public $minPrice = 0;
    public $maxPrice = 0;
    public $moreAttr;
    public $perPage = 12;
    public $priceRange;

    public $features = [];
    public $sizes  = [];

    public $sort  = 'latest';
    public $feature = [];
    public $size  = [];
    public $country;
    public $countries=[];


    public $state;
    public $states = [];

    public $city;
    public $cities = [];

    public $categories =[];
    public $category;
    public $properties=[];

    



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

    public function updatedCategory($newCategory)
    {
        $this->category = $newCategory;
        $this->updateFilteredProperties();
    }

    public function updatedCity($newState)
    {
        $this->updateFilteredProperties();
    }
    public function updateFilteredProperties()
    {
        $this->properties = Property::with('onSaleAttributes')
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

            ->when($this->city, function ($query) {
                $query->where('city_id', $this->city);
            })
            ->latest()
            ->get();

            // info(['country'=>$this->country, 'state'=>$this->state, 'city'=>$this->city]);





            // info(['propertis'=>$this->properties]);

       
    }


    public function mount(){
        $this->categories = Category::where('status', 1)
        ->where('in_home_page', '!=', 1)
        ->get();
        $this->countries = Country::get();
        $this->states = State::where('country_id', $this->country)->get();

        $this->properties = Property::with('onSaleAttributes')
        ->has('onSaleAttributes')
        ->when($this->country, function ($query) {
            $query->where('country_id', $this->country);
        })
        ->where('status', 1)
        ->take($this->perPage)
        ->latest()->get();

        $this->minPrice = $this->properties->first()->onSaleAttributes->min('price');
        $this->maxPrice = $this->properties->first()->onSaleAttributes->max('price');
    }

    public function render()
    {
        return view('livewire.child.country-properties');
    }
}
