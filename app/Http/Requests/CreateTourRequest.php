<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $travelId
 * @property Carbon $startingDate
 * @property Carbon $endingDate
 * @property float $price
 */
class CreateTourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'travelId' => 'required|exists:travels,id',
            'startingDate' => 'required|date',
            'endingDate' => 'required|date|after:startingDate',
            'price' => 'required|numeric',
        ];
    }
}
