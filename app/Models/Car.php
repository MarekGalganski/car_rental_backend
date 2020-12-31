<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    public function carBookings()
    {
        return $this->hasMany(CarBooking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function availableFor($from, $to): bool
    {
        return 0 === $this->carBookings()->betweenDates($from, $to)->count();
    }

    public function priceFor($from, $to): array
    {
        $days = (new Carbon($from))->diffInDays(new Carbon($to)) + 1;
        $totalPrice = $days * $this->price;

        return [
            'totalPrice' => $totalPrice,
            'breakdown' => [
                $this->price => $days
            ]
        ];
    }
}
