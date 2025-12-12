<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Forms\LoginForm;

class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->form->authenticate();
        return redirect()->intended('/');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
