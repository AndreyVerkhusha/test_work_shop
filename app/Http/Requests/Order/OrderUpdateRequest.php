<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest {
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
            'full_name'  => 'nullable',
            'product_id' => 'nullable|exists:products,id',
            'quantity'   => 'nullable|numeric|min:1',
            'comment'    => 'nullable',
            'status'     => 'nullable',
        ];
    }
}
