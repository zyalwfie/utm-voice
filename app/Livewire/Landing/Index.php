<?php

namespace App\Livewire\Landing;

use App\Models\Period;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('UTM Voice')]
class Index extends Component
{
    #[Computed()]
    public function periods()
    {
        return Period::currentOpen();
    }

    public function render()
    {
        // dd($this->periods());
        return view('livewire.landing.index');
    }
}
