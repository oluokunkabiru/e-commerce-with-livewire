<?php

namespace App\Http\Livewire\Admin\Feature;

use Livewire\Component;
use App\Admin\WithAdminDataTable;
use Illuminate\Support\Facades\Log;

class DataTable extends Component
{
    public $that = 'feature';
    public $model = 'Feature';

    use WithAdminDataTable;

    protected $queryString;

    public function __construct()
    {
        $this->queryString = $this->queryStringArr;

        $modelName = 'App\\Models\\' . $this->model;
        $this->obj = new $modelName();

        // Log::info(json_encode($this->queryString));

        // Log::info(json_encode($this->obj));

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
                $this->clearBasicAll();
                break;
        }
        $this->clearBasic($of);
    }

    public function getModelProperty($paginate = true)
    {
        $obj = $this->obj;
        $qry = $obj->where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('icon', 'like', '%' . $this->search . '%')
            ->orWhere('id', 'like', '%' . $this->search . '%');
        });


        return $this->getCommonModalProperty($qry, $paginate);
    }

    public function render()
    {
        $this->getCacheData();
        $items = $this->getModelProperty();

        // Log::info(json_encode($items));

        return view('livewire.admin.' . $this->that . '.data-table', compact('items'))
            ->layout('layouts.admin');
    }
}
