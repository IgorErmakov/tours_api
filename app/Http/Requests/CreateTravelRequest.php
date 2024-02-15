<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $slug
 * @property boolean $public
 * @property string $description
 * @property integer $numberOfDays
 * @property array $moods
 */
class CreateTravelRequest extends FormRequest
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
            'slug' => 'required|unique:travels|max:255',
            'public' => 'required|boolean',
            'description' => 'required',
            'numberOfDays' => 'required|integer',
            'moods' => 'array',
        ];
    }
}
