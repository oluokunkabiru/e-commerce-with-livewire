<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BecomeAgent extends Component
{

    public $agreement;
    public $amount;

    public function submit(){
        // return $this->agreement;
        $this->validate([
            'agreement' => 'accepted',

        ]);

        // return "hello";
        auth()->user()->assignRole("partner");
        return redirect()->route('dashboard.home');



    }

    
    public function render()
    {
        return view('livewire.become-agent');
    }
}
