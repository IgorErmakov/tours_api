<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $id
 * @property Carbon $startingDate
 * @property Carbon $endingDate
 * @property float $price
 */
class UpdateTourRequest extends FormRequest
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
            'startingDate' => 'required|date',
            'endingDate' => 'required|date',
            'price' => 'required|numeric',
        ];
    }
}
