<?php

namespace App\Livewire\Landing\Section;

use App\Models\Tag;
use Livewire\Component;
use Livewire\Attributes\Computed;

class AvailableCategories extends Component
{
    #[Computed()]
    public function tags()
    {
        return Tag::query()->withCount('facilities')->get();
    }

    public function render()
    {
        return view('livewire.landing.section.available-categories');
    }
}
