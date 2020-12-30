<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarBooking extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function scopeBetweenDates(Builder $query, $from, $to)
    {
        return $query->where('to', '>=', $from)
            ->where('from', '<=', $to);
    }

    public static function findByReviewKey(string $reviewKey): ?CarBooking
    {
        return static::where('review_key', $reviewKey)->with('car')->get()->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($carBooking) {
            $carBooking->review_key = Str::uuid();
        });
    }
}
