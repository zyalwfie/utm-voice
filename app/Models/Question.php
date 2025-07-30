<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $guarded = ['id'];

    protected $with = ['facility'];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
