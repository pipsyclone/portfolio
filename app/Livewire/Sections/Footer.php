<?php

namespace App\Livewire\Sections;

use App\Models\User;
use App\Models\Setting;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.sections.footer', [
            'user' => User::first(),
            'setting' => Setting::first()
        ]);
    }
}
