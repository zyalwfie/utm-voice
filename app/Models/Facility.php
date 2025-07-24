<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Facility extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\FacilityFactory> */
    use HasFactory, InteractsWithMedia, HasTags;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('carousel')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])
            ->useDisk('public');

        $this->addMediaCollection('detail')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])
            ->useDisk('public');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->quality(80)
            ->performOnCollections('carousel', 'detail')
            ->nonQueued();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeOrderByRating($query, $direction = 'desc')
    {
        return $query->leftJoin('comments', 'facilities.id', '=', 'comments.facility_id')
            ->selectRaw('facilities.*, AVG(comments.rating) as average_rating')
            ->groupBy('facilities.id')
            ->orderBy('average_rating', $direction);
    }

    public function getTagNamesAttribute()
    {
        return $this->tags->pluck('name')->toArray();
    }

    public function scopeWithTag($query, $tagName)
    {
        return $query->withAnyTags([$tagName]);
    }

    public function scopeWithTags($query, array $tagNames)
    {
        return $query->withAnyTags($tagNames);
    }
}
