<?php

namespace App\Http\Livewire\Child;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Property;
use App\Models\State;
use Illuminate\Http\Request;
use Livewire\Component;

class SearchForm extends Component
{
    public $search;
    public $country;
    public $countries=[];


    public $state;
    public $states = [];

    public $city;
    public $cities = [];

    public $categories=[];
    public $category;





    public function updatedCountry($newCountry)
    {
        $this->states = State::where('country_id', $newCountry)->get();
        $this->state = null; // Reset selected state
        $this->city = null; // Reset selected city

        // Update properties based on the selected filters
        // $this->updateFilteredProperties();
    }

    public function updatedState($newState)
    {
        $this->cities = City::where('state_id', $newState)->get();
        $this->city = null; // Reset selected city

        // Update properties based on the selected filters
        // $this->updateFilteredProperties();
    }

    public function updateCategory($newCategory)
    {

        // Update properties based on the selected filters
        // $this->updateFilteredProperties();
    }

    public function updatedSearch()
    {
        return redirect()->route("search",['searching'=>$this->search,'country'=>$this->country, 'state'=>$this->state,'city'=>$this->city]);
    }

    public function searchTags(Request $request)
    {
        $term = $request->term;
        return Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where(function ($qry) use ($term) {
                $qry->where('name', 'like', '%' . $term . '%')
                    ->orWhere('slug', 'like', '%' . $term . '%')
                    ->orWhere('short_description', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%')
                    ->orWhere('keywords', 'like', '%' . $term . '%')
                    ->orWhere('technical_specification', 'like', '%' . $term . '%')
                    ->orWhere('warrenty', 'like', '%' . $term . '%')


                    ->orWhereHas('category', function ($query) use ($term) {
                        $query->where('name', 'like', '%' . $term . '%')
                            ->where('status', 1)
                            ->orWhere('slug', 'like', '%' . $term . '%');
                    });

            })->latest()->pluck('name');
    }



    public function render()
    {
        $this->categories = Category::where('status', 1)->get(['name', 'id']);
        $this->countries = Country::get();
        CurrencyRate();
        return view('livewire.child.search-form');
    }
}
