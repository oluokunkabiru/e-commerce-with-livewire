<?php

namespace App\Http\Livewire\Admin;

use App\Models\AboutsUs;
use Livewire\Component;

class AboutUs extends Component
{
    public $about;
    public $mission;
    public $vision;
    public $what_we_do;
    public $agreement;

    public function dehydrate()
    {
        $this->emit('setEditor');
    }

    public function submit()
    {
        if (!can('manage about us')) {
            return;
        }

        $this->validate(
            [
                'about' => 'required|string',
                'mission' => 'required|string',
                'vision' => 'required|string',

            ]
        );
        $aboutUs = AboutsUs::first();

        if ($aboutUs) {
            $aboutUs->update([
                'about' => $this->about,
                'mission' => $this->mission,
                'vision' => $this->vision,
                'agreement' => $this->agreement,
                'what_we_do' => $this->what_we_do,
            ]);
        } else {
            AboutsUs::create([
            'about' => $this->about,
            'mission' => $this->mission,
            'vision' => $this->vision,
            'what_we_do' => $this->what_we_do,]);
        }

        session()->flash('success_msg', 'Saved');
    }

    public function mount()
    {
        $this->about = AboutsUs::first()->about;
        $this->mission = AboutsUs::first()->mission;
        $this->vision = AboutsUs::first()->vision;
        $this->agreement = AboutsUs::first()->agreement;
        $this->what_we_do = AboutsUs::first()->what_we_do;
    }

    public function render()
    {
        return view('livewire.admin.about-us')
            ->layout('layouts.admin');
    }
}
