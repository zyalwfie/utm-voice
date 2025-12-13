<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = ['year', 'start_date', 'end_date', 'is_open', 'name'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function currentOpen()
    {
        return self::where('is_open', true)->orderByDesc('year')->first();
    }
}
