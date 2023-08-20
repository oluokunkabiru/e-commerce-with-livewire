<?php

namespace App\Http\Livewire\Admin\Feature;

use App\Models\Feature;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DataEntry extends Component
{
    public $that   = 'feature';
    public $thatUp = 'Feature';
    public $editId = '';

    public $icon = '';
    public $name = '';

    public $feature;

    public function submit()
    {
        $validationArr = '' != $this->editId ? [
            'icon' => ['required'],
        ]
        : [
            'name' => 'required|unique:features',
        ];

        $this->validate($validationArr);

        $form = [
            'icon' => $this->icon,
            'name' => $this->name,
        ];

        $status = "added";

        if ('' != $this->editId && $this->feature && can('edit feature')) {
            $this->feature->update($form);
            $status = "updated";
        } else if (can('add feature')) {
            Feature::create($form);
        }

        session()->flash('success_msg', $this->thatUp . ' ' . $status);
        return redirect()->route('dashboard.' . $this->that);
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->feature  = Feature::where('id', $id)->firstOrFail();
            $this->icon  = $this->feature->icon;
            $this->name  = $this->feature->name;
            $this->editId = $this->feature->id;
        }
    }

    public function render()
    {
        return view('livewire.admin.' . $this->that . '.data-entry')
            ->layout('layouts.admin');
    }
}
