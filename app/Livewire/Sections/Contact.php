<?php

namespace App\Livewire\Sections;

use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $email;
    public $address;
    public $phone;

    // Form fields
    public $name = '';
    public $senderEmail = '';
    public $subject = '';
    public $message = '';

    public function mount()
    {
        $data = User::first();
        $this->email = $data->email;
        $this->address = $data->address;
        $this->phone = $data->phone;
    }

    public function sendMessage()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:100',
            'senderEmail' => 'required|email|max:150',
            'subject' => 'required|string|min:3|max:200',
            'message' => 'required|string|min:10|max:5000',
        ], [
            'name.required' => __('Please enter your name.'),
            'name.min' => __('Name must be at least 2 characters.'),
            'senderEmail.required' => __('Please enter your email address.'),
            'senderEmail.email' => __('Please enter a valid email address.'),
            'subject.required' => __('Please enter a subject.'),
            'subject.min' => __('Subject must be at least 3 characters.'),
            'message.required' => __('Please enter your message.'),
            'message.min' => __('Message must be at least 10 characters.'),
        ]);

        try {
            $recipientEmail = User::first()->email;

            Mail::to($recipientEmail)->send(new ContactMail(
                senderName: $this->name,
                senderEmail: $this->senderEmail,
                subject: $this->subject,
                messageBody: $this->message,
            ));

            $this->reset(['name', 'senderEmail', 'subject', 'message']);

            session()->flash('contact-success', __('Your message has been sent successfully! Thank you for reaching out.'));
        } catch (\Exception $e) {
            session()->flash('contact-error', __('Sorry, there was an error sending your message. Please try again later.'));
        }
    }

    public function render()
    {
        return view('livewire.sections.contact', [
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);
    }
}
