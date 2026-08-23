<?php

namespace App\Livewire\Sections;
use App\Models\User;
use App\Models\Setting;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        $user = User::first();

        return view('livewire.sections.hero', [
            'user' => $user,
            'setting' => Setting::first(),
            'projectsCount' => Projects::count(),
            'certificationsCount' => is_array($user?->certifications) ? count($user->certifications) : 0,
        ]);
    }
}
