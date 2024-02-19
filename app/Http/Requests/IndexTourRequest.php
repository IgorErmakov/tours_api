<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $page
 * @property string $slug
 * @property float $priceFrom
 * @property float $priceTo
 * @property string $dateFrom
 * @property string $dateTo
 * @property string $sort
 * @property string $sortDir
 */
class IndexTourRequest extends FormRequest
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
            'page' => 'integer',
            'slug' => 'required',
            'dateFrom' => 'date',
            'dateTo' => 'date',
            'priceFrom' => 'numeric',
            'priceTo' => 'numeric',
            'sort' => 'in:price',
            'sortDir' => 'in:asc,desc',
        ];
    }
}
