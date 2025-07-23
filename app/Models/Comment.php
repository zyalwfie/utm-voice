<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $with = ['facility', 'user'];

    protected $fillable = [
        'facility_id',
        'user_id',
        'content',
        'rating',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scope for published comments
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope for unpublished comments
    public function scopeUnpublished($query)
    {
        return $query->where('is_published', false);
    }

    // Scope for pending review (unpublished)
    public function scopePendingReview($query)
    {
        return $query->where('is_published', false);
    }
}
