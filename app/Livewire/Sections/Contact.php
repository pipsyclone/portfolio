<?php

namespace App\Livewire\Sections;

use App\Models\User;
use Livewire\Component;

class Contact extends Component
{
    public $email;
    public $address;
    public $phone;

    public function mount() {
        $data = User::first();
        $this->email = $data->email;
        $this->address = $data->address;
        $this->phone = $data->phone;
    }

    public function render()
    {
        return view('livewire.sections.contact', [
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone
        ]);
    }
}
