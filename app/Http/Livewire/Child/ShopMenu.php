<?php

namespace App\Http\Livewire\Child;

use App\Models\Category;
use Livewire\Component;

class ShopMenu extends Component
{
    public function render()
    {
        $categories = Category::with('subCategories')
            ->withCount('subCategories')
            // ->has('products')
            // ->where('parent_category', '=', null)
            // ->orderBy('sub_categories_count', 'desc')
            ->where('status', 1)
            ->where('in_home_page', 1)
            ->get();

        return view('livewire.child.shop-menu', ['categories' => $categories]);
    }
}
