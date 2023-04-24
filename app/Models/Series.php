<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;
use App\Models\Episode;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cover'
    ];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function ($queryBuilder) {
            $queryBuilder->orderBy('nome');
        }); 
    }
}
