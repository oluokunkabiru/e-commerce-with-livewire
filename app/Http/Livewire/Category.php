<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use App\Models\Property;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $category;
    public $minPrice = 0;
    public $maxPrice = 0;
    public $moreAttr;
    public $perPage = 10;

    public $features = [];
    public $sizes  = [];

    public $sort  = 'latest';
    public $feature = [];
    public $size  = [];

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
    }

    public function updatedFeature()
    {
        $this->emit('resetPriceRange');
    }

    public function updatedSize()
    {
        $this->emit('resetPriceRange');
    }

    public function mount($slug)
    {
        Log::info($slug);
        $this->category = ModelsCategory::where('slug', $slug)->with('subCategories')->firstOrFail();
    }

    public function render()
    {
        $qry = Property::where('category_id', $this->category->id);

        $qry->with('onSaleAttributes', function ($query) {
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

        })->withCount('onSaleAttributes');

        if ('oldest' == $this->sort) {
            $qry->oldest();
        } elseif ('a-z' == $this->sort) {
            $qry->orderBy('name', 'asc');
        } elseif ('z-a' == $this->sort) {
            $qry->orderBy('name', 'desc');
        } else {
            $qry->latest();
        }

        $products = $qry->paginate($this->perPage);

        $allProducts = Property::where('category_id', $this->category->id)->has('onSaleAttributes')->get();

        $this->minPrice = $allProducts->first()->onSaleAttributes->min('price');
        $this->maxPrice = $allProducts->first()->onSaleAttributes->max('price');

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

        return view('livewire.category', ['products' => $products])
            ->extends('layouts.app')
            ->section('contents');
    }
}
