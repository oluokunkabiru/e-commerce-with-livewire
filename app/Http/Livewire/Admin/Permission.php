<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class Permission extends Component
{

    public $permissions = [];
    public $roles = [];
    public $role=null;
    public $permission = null;
    public $selectedPermissions = [];



    public function loadRolePermissions()
{
    if ($this->role) {
        $selectedRole = Role::findByName($this->role);
        if ($selectedRole) {
            $this->selectedPermissions = $selectedRole->permissions->pluck('name')->toArray();
        }
    }
}
    public function submit()
    {
        if ($this->role && count($this->selectedPermissions) > 0) {
            $role = Role::findByName($this->role);

            if ($role) {
                $role->syncPermissions($this->selectedPermissions);
            }
        }
    }


    public function mount()
    {
        $this->permissions =  ModelsPermission::where('guard_name', 'web')->get();
        $this->roles = Role::get();
        $this->role= Auth::user()->getRoleNames()->first();

        if ($this->role) {
            $selectedRole = Role::findByName($this->role);
            if ($selectedRole) {
                $this->selectedPermissions = $selectedRole->permissions->pluck('name')->toArray();
            }
        }

    }

    public function render()
    {
        return view('livewire.admin.permission')->layout('layouts.admin');
    }
}
