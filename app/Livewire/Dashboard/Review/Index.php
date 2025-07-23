<?php

namespace App\Livewire\Dashboard\Review;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

#[Layout('components.layouts.dashboard')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $query = '';
    public $statusFilter = 'pending'; // pending, published, all
    public $ratingFilter = '';
    public $selectedCommentId = null;

    // Modal states
    public $showPublishModal = false;
    public $showUnpublishModal = false;
    public $showDeleteModal = false;

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedRatingFilter()
    {
        $this->resetPage();
    }

    // Open publish modal
    public function openPublishModal($commentId)
    {
        $this->selectedCommentId = $commentId;
        $this->showPublishModal = true;
    }

    // Close publish modal
    public function closePublishModal()
    {
        $this->showPublishModal = false;
        $this->selectedCommentId = null;
    }

    // Open unpublish modal
    public function openUnpublishModal($commentId)
    {
        $this->selectedCommentId = $commentId;
        $this->showUnpublishModal = true;
    }

    // Close unpublish modal
    public function closeUnpublishModal()
    {
        $this->showUnpublishModal = false;
        $this->selectedCommentId = null;
    }

    // Open delete modal
    public function openDeleteModal($commentId)
    {
        $this->selectedCommentId = $commentId;
        $this->showDeleteModal = true;
    }

    // Close delete modal
    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->selectedCommentId = null;
    }

    // Publish comment
    public function publishComment()
    {
        $comment = Comment::findOrFail($this->selectedCommentId);
        $comment->update(['is_published' => true]);

        $this->closePublishModal();
        session()->flash('message', 'Ulasan berhasil dipublikasikan.');
    }

    // Unpublish comment
    public function unpublishComment()
    {
        $comment = Comment::findOrFail($this->selectedCommentId);
        $comment->update(['is_published' => false]);

        $this->closeUnpublishModal();
        session()->flash('message', 'Ulasan berhasil tidak dipublikasikan.');
    }

    // Delete comment
    public function deleteComment()
    {
        $comment = Comment::findOrFail($this->selectedCommentId);
        $comment->delete();

        $this->closeDeleteModal();
        session()->flash('message', 'Ulasan berhasil dihapus.');
    }

    // Bulk actions
    public function bulkPublish($commentIds)
    {
        Comment::whereIn('id', $commentIds)->update(['is_published' => true]);
        session()->flash('message', 'Ulasan terpilih berhasil dipublikasikan.');
    }

    public function bulkUnpublish($commentIds)
    {
        Comment::whereIn('id', $commentIds)->update(['is_published' => false]);
        session()->flash('message', 'Ulasan terpilih berhasil tidak dipublikasikan.');
    }

    public function bulkDelete($commentIds)
    {
        Comment::whereIn('id', $commentIds)->delete();
        session()->flash('message', 'Ulasan terpilih berhasil dihapus.');
    }

    #[Computed()]
    public function comments()
    {
        $query = Comment::with(['facility', 'user']);

        // Search filter
        if ($this->query) {
            $query->where(function ($q) {
                $q->where('content', 'like', "%{$this->query}%")
                    ->orWhereHas('facility', function ($facility) {
                        $facility->where('name', 'like', "%{$this->query}%");
                    })
                    ->orWhereHas('user', function ($user) {
                        $user->where('name', 'like', "%{$this->query}%");
                    });
            });
        }

        // Status filter
        if ($this->statusFilter === 'published') {
            $query->published();
        } elseif ($this->statusFilter === 'pending') {
            $query->unpublished();
        }
        // 'all' doesn't add any filter

        // Rating filter
        if ($this->ratingFilter) {
            $query->where('rating', $this->ratingFilter);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    #[Computed()]
    public function pendingCount()
    {
        return Comment::unpublished()->count();
    }

    #[Computed()]
    public function publishedCount()
    {
        return Comment::published()->count();
    }

    #[Computed()]
    public function totalCount()
    {
        return Comment::count();
    }

    public function render()
    {
        return view('livewire.dashboard.review.index');
    }
}
