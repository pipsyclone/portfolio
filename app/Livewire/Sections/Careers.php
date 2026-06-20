<?php

namespace App\Livewire\Sections;

use App\Models\User;
use Livewire\Component;

class Careers extends Component
{
    public function render()
    {
        return view('livewire.sections.careers', [
            'user' => User::first(),
        ]);
    }
}
