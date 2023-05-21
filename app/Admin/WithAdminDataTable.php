<?php

namespace App\Admin;

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;

trait WithAdminDataTable
{
    use WithPagination;

    public $obj;

    public $selected    = [];
    public $selectPage  = false;
    public $isAllSelect = false;

    public $sortedField = 'id';
    public $sortedOrder = 'desc';
    public $sorted      = '';

    public $perPage = 10;

    public $search = '';

    public $addedOnFrom = '';
    public $addedOnTo   = '';

    public $deletedAtFrom = '';
    public $deletedAtTo   = '';

    public $status = '';

    public $onlyTrashed = false;

    public $hasPhoto = false;

    public $queryStringArr = [
        'search'        => ['except' => ''],

        'addedOnFrom'   => ['except' => ''],
        'addedOnTo'     => ['except' => ''],

        'deletedAtFrom' => ['except' => ''],
        'deletedAtTo'   => ['except' => ''],

        'status'        => ['except' => ''],
        'onlyTrashed'   => ['except' => false],
    ];

    public function updatedAddedOnFrom()
    {
        $this->addedOnFrom = '' != $this->addedOnTo ? ($this->addedOnFrom > $this->addedOnTo ? $this->addedOnTo : $this->addedOnFrom)
        : ($this->addedOnFrom > date('Y-m-d') ? date('Y-m-d') : $this->addedOnFrom);
    }

    public function updatedAddedOnTo()
    {
        $this->addedOnTo   = $this->addedOnTo > date('Y-m-d') ? date('Y-m-d') : $this->addedOnTo;
        $this->addedOnFrom = '' != $this->addedOnTo ? ($this->addedOnFrom > $this->addedOnTo ? $this->addedOnTo : $this->addedOnFrom)
        : $this->addedOnFrom;
    }

    public function updatedDeletedAtFrom()
    {
        $this->deletedAtFrom = '' != $this->deletedAtTo ? ($this->deletedAtFrom > $this->deletedAtTo ? $this->deletedAtTo : $this->deletedAtFrom)
        : ($this->deletedAtFrom > date('Y-m-d') ? date('Y-m-d') : $this->deletedAtFrom);
    }

    public function updatedDeletedAtTo()
    {
        $this->deletedAtTo   = $this->deletedAtTo > date('Y-m-d') ? date('Y-m-d') : $this->deletedAtTo;
        $this->deletedAtFrom = '' != $this->deletedAtTo ? ($this->deletedAtFrom > $this->deletedAtTo ? $this->deletedAtTo : $this->deletedAtFrom)
        : $this->deletedAtFrom;
    }

    public function updatedPerPage()
    {
        $this->perPage = 0 == $this->perPage ? 10 : $this->perPage;
        $this->resetPage();
        Cache::put($this->that . '.perPage', $this->perPage);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSelected()
    {
        $this->selected    = [];
        $this->selectPage  = false;
        $this->isAllSelect = false;
    }

    public function clearBasic($of)
    {
        switch ($of) {
            case 'search':
                $this->search = '';
                break;
            case 'addedOnFrom':
                $this->addedOnFrom = '';
                break;
            case 'addedOnTo':
                $this->addedOnTo = '';
                break;
            case 'deletedAtFrom':
                $this->deletedAtFrom = '';
                break;
            case 'deletedAtTo':
                $this->deletedAtTo = '';
                break;
            case 'status':
                $this->status = '';
                break;
        }
    }

    public function clearBasicAll()
    {
        $this->status        = '';
        $this->search        = '';
        $this->deletedAtTo   = '';
        $this->deletedAtFrom = '';
        $this->addedOnFrom   = '';
        $this->addedOnTo     = '';
    }

    public function updatedSelected()
    {
        $this->isAllSelect = false;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selected = $this->getModelProperty()->pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->isAllSelect = false;
            $this->selected    = [];
        }
    }

    public function sort($filed, $order)
    {
        $this->sortedOrder = $order;
        $this->sortedField = $filed;

        $trash = $this->onlyTrashed ? 'Trashed' : '';

        Cache::put($this->that . '.sortedOrder' . $trash, $order);
        Cache::put($this->that . '.sortedField' . $trash, $filed);
    }

    public function trash()
    {
        if (can('edit ' . $this->that)) {
            $this->onlyTrashed = true;
            $this->resetPage();
            $this->clearSelected();
        }
    }

    public function all()
    {
        $this->onlyTrashed   = false;
        $this->deletedAtFrom = '';
        $this->deletedAtTo   = '';
        $this->resetPage();
        $this->clearSelected();
    }

    public function getCacheData()
    {
        $trash             = $this->onlyTrashed ? 'Trashed' : '';
        $this->perPage     = Cache::has($this->that . '.perPage') ? Cache::get($this->that . '.perPage') : $this->perPage;
        $this->sortedField = Cache::has($this->that . '.sortedField' . $trash) ? Cache::get($this->that . '.sortedField' . $trash) : $this->sortedField;
        $this->sortedOrder = Cache::has($this->that . '.sortedOrder' . $trash) ? Cache::get($this->that . '.sortedOrder' . $trash) : $this->sortedOrder;
        $this->sorted      = $this->sortedField . '' . $this->sortedOrder;
    }

    public function deleteChecked()
    {
        if (can('edit ' . $this->that)) {
            $this->obj->destroy($this->selected);
            $this->clearSelected();
        }
    }

    public function forceDeleteChecked()
    {
        if (can('edit ' . $this->that)) {
            $items = $this->obj->onlyTrashed()->whereIn('id', $this->selected)->get();
            foreach ($items as $item) {
                if ($this->hasPhoto) {
                    MediaController::delete($this->namespace, $item->id);
                }
                $item->forceDelete();
            }
            $this->clearSelected();
        }
    }

    public function directForceDeleteChecked()
    {
        if (can('edit ' . $this->that)) {
            $items = $this->obj->whereIn('id', $this->selected)->get();
            foreach ($items as $item) {
                if ($this->hasPhoto) {
                    MediaController::delete($this->namespace, $item->id);
                }
                $item->forceDelete();
            }
            $this->clearSelected();
        }
    }

    public function restoreChecked()
    {
        if (can('edit ' . $this->that)) {
            $this->obj->onlyTrashed()->whereIn('id', $this->selected)->restore();
            $this->clearSelected();
        }
    }

    public function activeChecked()
    {
        if (can('edit ' . $this->that)) {
            $this->obj->whereIn('id', $this->selected)->update(['status' => 1]);
        }
    }

    public function deactiveChecked()
    {
        if (can('edit ' . $this->that)) {
            $this->obj->whereIn('id', $this->selected)->update(['status' => 0]);
        }
    }

    public function status($id, $status)
    {
        if (can('edit ' . $this->that)) {
            $data   = $this->obj->findOrFail($id);
            $status = (1 == $status) ? 0 : 1;
            $data->update(['status' => $status]);
        }
    }

    public function delete($id)
    {
        if (can('edit ' . $this->that)) {
            $this->obj->destroy($id);
        }
    }

    public function forceDelete($id)
    {
        if (can('edit ' . $this->that)) {
            $data = $this->obj->onlyTrashed()->find($id);
            if ($data) {
                if ($this->hasPhoto) {
                    MediaController::delete($this->namespace, $data->id);
                }
                $data->forceDelete();
            }
        }
    }

    public function restoreRow($id)
    {
        if (can('edit ' . $this->that)) {
            $data = $this->obj->onlyTrashed()->find($id);
            if ($data) {
                $data->restore();
            }
        }
    }

    public function getCommonModalProperty($qry, $paginate)
    {
        $this->onlyTrashed ? $qry->onlyTrashed() : '';'activated' == $this->status ? $qry->where('status', 1) : '';'deactivated' == $this->status ? $qry->where('status', 0) : '';'' != $this->addedOnFrom ? $qry->where('created_at', '>=', $this->addedOnFrom . ' 00:00:00') : '';'' != $this->addedOnTo ? $qry->where('created_at', '<=', $this->addedOnTo . ' 23:59:59') : '';

        if ($this->onlyTrashed) {
            $this->deletedAtFrom != ''
            ? $qry->where('deleted_at', '>=', $this->deletedAtFrom . ' 00:00:00') : '';'' != $this->deletedAtTo ? $qry->where('deleted_at', '<=', $this->deletedAtTo . ' 23:59:59') : '';
        }

        $qry->orderBy($this->sortedField, $this->sortedOrder);
        return $paginate ? $qry->paginate($this->perPage) : $qry->pluck('id');
    }
}
