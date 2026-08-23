<?php

namespace App\Livewire\Sections;

use App\Models\User;
use Livewire\Component;

class Certifications extends Component
{
    public function render()
    {
        $user = User::first();
        $certifications = is_array($user?->certifications) ? $user->certifications : [];

        return view('livewire.sections.certifications', [
            'certifications' => $certifications,
        ]);
    }
}
