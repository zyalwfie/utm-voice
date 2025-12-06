<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $fillable = [
        'user_id',
        'question_id',
        'content',
    ];

    protected $with = ['question', 'user'];

    /**
     * Get the question that this answer belongs to.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the user who submitted this answer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rating value as integer.
     */
    public function getRatingAttribute(): int
    {
        return (int) $this->content;
    }

    /**
     * Get the rating label based on content value.
     */
    public function getRatingLabelAttribute(): string
    {
        return match ((int) $this->content) {
            1 => 'Sangat Tidak Puas',
            2 => 'Tidak Puas',
            3 => 'Cukup',
            4 => 'Puas',
            5 => 'Sangat Puas',
            default => 'Tidak Valid',
        };
    }
}
