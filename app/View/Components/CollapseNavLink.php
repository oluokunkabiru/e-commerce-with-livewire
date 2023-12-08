<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CollapseNavLink extends Component
{
    public $icon;
    public $label;
    public $rand;
    public $permissions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $label, $permissions = null)
    {
        $this->icon        = $icon;
        $this->label       = $label;
        $this->rand        = rand(11111, 99999);
        $this->permissions = explode(',', $permissions);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {        
        // auth()->user()->hasAnyDirectPermission($this->permissions)
        // info(auth()->user()->hasAnyDirectPermission($this->permissions));getPermissionsViaRoles getAllPermissions
        return 
        auth()->user()->hasAnyPermission($this->permissions)
        ? view('components.collapse-nav-link')
        : null;
    }
}
