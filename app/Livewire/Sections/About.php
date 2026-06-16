<?php

namespace App\Livewire\Sections;

use App\Models\User;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.sections.about', [
            'user' => User::first(),
        ]);
    }
}
