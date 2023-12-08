<?php

namespace App\Http\Livewire\Child;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;

class UpdateProfile extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $address;
    public $zip;
    public $company;
    public $country;
    public $countries=[];


    public $state;
    public $states = [];

    public $city;
    public $cities = [];


    public function updatedCountry($newCountry)
    {
        $this->states = State::where('country_id', $newCountry)->get();
        $this->state = null; // Reset selected state
        $this->city = null; // Reset selected city
        
    }

    public function updatedState($newState)
    {
        $this->cities = City::where('state_id', $newState)->get();
        $this->city = null; // Reset selected city
      
    }
    
    public function submit()
    {
        $this->validate(['name' => 'required']);

        $user = User::findOrFail(auth()->user()->id);

        $user->name = $this->name;
        $user->mobile = $this->mobile;
        $user->address = $this->address;
        $user->city_id = $this->city;
        $user->country_id = $this->country;
        $user->state_id = $this->state;
        $user->zip = $this->zip;
        $user->company = $this->company;

        $user->save();

        session()->flash('success_msg', 'Profile information updated.');
    }

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->mobile = $user->mobile;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->city = $user->city_id;
        $this->state = $user->state_id;
        $this->zip = $user->zip;
        $this->company = $user->company;
        $this->country =$user->country_id ? $user->country_id :Country()->id;

        $this->countries = Country::get();
        $this->states = State::where('country_id', $this->country)->get();
    }

    public function render()
    {
        return view('livewire.child.update-profile');
    }
}
