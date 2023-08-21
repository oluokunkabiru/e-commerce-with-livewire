<?php

namespace App\Http\Livewire\Admin\Property;

use Livewire\Component;
use App\Admin\WithProductDataTable;

class DataTable extends Component
{
    public $that = 'property';
    public $model = 'Property';

    public $promotional;
    public $featured;
    public $best_seller;
    public $discounted;
    public $trending;

    use WithProductDataTable;

    protected $queryString;

    public function __construct()
    {
        $this->queryStringArr = array_merge($this->queryStringArr, [
            'promotional' => ['except' => false],
            'featured' => ['except' => false],
            'best_seller' => ['except' => false],
            'discounted' => ['except' => false],
            'trending' => ['except' => false],
        ]);

        $this->hasPhoto = true;

        $this->queryString = $this->queryStringArr;

        $modelName = 'App\\Models\\' . $this->model;
        $this->obj = new $modelName();
    }

    public function selectAll()
    {
        if ($this->isAllSelect == false) {
            $this->selected = $this->onlyTrashed == true
                ? $this->getModelProperty(false)->map(fn ($id) => (string) $id)
                : $this->getModelProperty(false)->map(fn ($id) => (string) $id);
            $this->isAllSelect = true;
            $this->selectPage = true;
        } else {
            $this->clearSelected();
        }
    }

    public function clear($of)
    {
        switch ($of) {
            case 'all':
                $this->reset(['trending', 'promotional', 'featured', 'discounted', 'best_seller']);
                $this->clearBasicAll();
                break;
            case 'trending':
                $this->reset('trending');
                break;
            case 'promotional':
                $this->reset('promotional');
                break;
            case 'featured':
                $this->reset('featured');
                break;
            case 'discounted':
                $this->reset('discounted');
                break;
            case 'best_seller':
                $this->reset('best_seller');
                break;
        }
        $this->clearBasic($of);
    }

    public function getModelProperty($paginate = true)
    {
        $obj = $this->obj;

        $qry = $obj->with(['category', 'country', 'state', 'city'])->withCount('propertyDetails')->where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhereHas('category', function ($qry) {
                    $qry->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('country', function ($qry) {
                    $qry->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('state', function ($qry) {
                    $qry->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('city', function ($qry) {
                    $qry->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%');
                })
                ->orWhere('slug', 'like', '%' . $this->search . '%')
                ->orWhere('short_description', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('keywords', 'like', '%' . $this->search . '%')
                // ->orWhere('technical_specification', 'like', '%' . $this->search . '%')
                // ->orWhere('usage', 'like', '%' . $this->search . '%')
                ->orWhere('warrenty', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%');
        });

        return $this->getCommonModalProperty($qry, $paginate);
    }

    public function render()
    {
        $this->getCacheData();
        $items = $this->getModelProperty();

        return view('livewire.admin.' . $this->that . '.data-table', compact('items'))
            ->layout('layouts.admin');
    }
}
