<?php

namespace App\Livewire\Landing\Section;

use App\Models\Comment;
use Livewire\Attributes\Computed;
use Livewire\Component;

class RecentReviews extends Component
{
    #[Computed()]
    public function recentComments()
    {
        return Comment::orderBy('created_at', 'asc')->get()->take(3);
    }

    public function render()
    {
        return view('livewire.landing.section.recent-reviews');
    }
}
