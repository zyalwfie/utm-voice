<?php

namespace App\Livewire\Dashboard\Review;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.review.index');
    }
}
