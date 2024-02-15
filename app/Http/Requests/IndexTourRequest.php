<?php

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
 *
 * A public (no auth) endpoint to get a list of paginated tours by the travel slug
 * (e.g. all the tours of the travel foo-bar). Users can filter (search) the results by
 * priceFrom, priceTo, dateFrom (from that startingDate) and dateTo (until that startingDate).
 * User can sort the list by price asc and desc.
 * They will always be sorted, after every additional user-provided filter, by startingDate asc.
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
