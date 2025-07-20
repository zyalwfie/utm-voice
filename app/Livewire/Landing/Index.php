<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('UTM Voice')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.landing.index');
    }
}
