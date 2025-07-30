<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    protected $guarded = ['id'];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
