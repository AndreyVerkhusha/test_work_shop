<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'full_name'  => 'required',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|numeric|min:1',
            'comment'    => 'nullable',
        ];
    }
}
