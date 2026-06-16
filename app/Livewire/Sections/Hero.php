<?php

namespace App\Livewire\Sections;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        return view('livewire.sections.hero', [
            'user' => User::first(),
            'setting' => Setting::first()
        ]);
    }
}
