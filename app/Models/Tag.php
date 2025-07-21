<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
    use HasFactory;

    public function facilities(): MorphToMany
    {
        return $this->morphedByMany(Facility::class, 'taggable');
    }
}
