<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $bestSellers = Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('best_seller', 1)
            ->where('status', 1)
            ->latest()->get();

        $featureds = Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('featured', 1)
            ->where('status', 1)
            ->latest()->get();

        $trendings = Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('trending', 1)
            ->where('status', 1)
            ->latest()->get();

        $discounteds = Property::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('discounted', 1)
            ->where('status', 1)
            ->latest()->get();

        return view('livewire.home', [
            'bestSellers' => $bestSellers,
            'featureds'   => $featureds,
            'trendings'   => $trendings,
            'discounteds' => $discounteds,
        ])
            ->extends('layouts.app')
            ->section('contents');
    }
}
