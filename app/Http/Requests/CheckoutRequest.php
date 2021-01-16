<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bookings' => 'bail|required|array|min:1',
            'bookings.*.car_id' => 'required|exists:cars,id',
            'bookings.*.user_id' => 'required|exists:users,id',
            'bookings.*.from' => 'required|date_format:Y-m-d|after:today',
            'bookings.*.to' => 'required|date_format:Y-m-d|after_or_equal:bookings.*.from',
            'bookings.*' => ['required', function($attribute, $value, $fail) {
                $car = Car::findOrFail($value['car_id']);

                if (!$car->availableFor($value['from'], $value['to'])) {
                    $fail('The object is not available in given dates.');
                }
            }],
            'address.first_name' => 'required|min:2',
            'address.last_name' => 'required|min:2',
            'address.street' => 'required|min:2',
            'address.zip' => 'required|min:2',
            'address.city' => 'required|min:2',
            'address.phone_number' => 'required|min:2',
            'address.email' => 'required|email',
        ];
    }
}
