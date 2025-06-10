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
    

    public function render()
    {


        return view('livewire.home')
            ->extends('layouts.app')
            ->section('contents')
            ;
    }
}
