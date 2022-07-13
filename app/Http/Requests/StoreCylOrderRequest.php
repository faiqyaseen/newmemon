<?php

namespace App\Http\Requests;

use App\Models\Cylinder;
use Illuminate\Foundation\Http\FormRequest;

class StoreCylOrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => 'required',
            'commercial' => "nullable|numeric|max:".$this->count(1),
            'domestic' => "nullable|numeric|max:".$this->count(2),
            'domestic6' => "nullable|numeric|max:".$this->count(3),
            'domestic10' => "nullable|numeric|max:".$this->count(4),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'customer_id.required' => 'A Customer is required',
            'commercial.max' => "Remaining Filled Commercial (45.4kg) Cylinders Are ".$this->count(1),
            'domestic.max' => "Remaining Filled Domestic (11.8kg) Cylinders Are ".$this->count(2),
            'domestic6.max' => "Remaining Filled Domestic (6kg) Cylinders Are ".$this->count(3),
            'domestic10.max' => "Remaining Filled Domestic (10kg) Cylinders Are ".$this->count(4),
        ];
    }

    protected function count($type)
    {
        $commercial_count = Cylinder::where([
            'type' => 1,
            'condition' => 1,
            'is_filled' => 1,
            'branch_id' => 1,
            'assign_to' => 0,
            'sell_to' => 0
        ])->count();

        $domestic_count = Cylinder::where([
            'type' => 2,
            'condition' => 1,
            'is_filled' => 1,
            'branch_id' => 1,
            'assign_to' => 0,
            'sell_to' => 0
        ])->count();

        $domestic6_count = Cylinder::where([
            'type' => 3,
            'condition' => 1,
            'is_filled' => 1,
            'branch_id' => 1,
            'assign_to' => 0,
            'sell_to' => 0
        ])->count();

        $domestic10_count = Cylinder::where([
            'type' => 4,
            'condition' => 1,
            'is_filled' => 1,
            'branch_id' => 1,
            'assign_to' => 0,
            'sell_to' => 0
        ])->count();

        if ($type == 1) {
            return $commercial_count;
        } else if ($type == 2) {
            return $domestic_count;
        } else if ($type == 3) {
            return $domestic6_count;
        } else if ($type == 4) {
            return $domestic10_count;
        }
    }
}
