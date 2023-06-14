<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->customer()->isApproved();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "cc_number"  => "required|max:25",
            "cc_cvc" => "required|min:3|max:4",
            "cc_expiry_month" => "required|numeric|min:1|max:12",
            "cc_expiry_year" => "required|numeric|min:23|max:99",
            "subscription_id" => "required|exists:subscriptions,id"
        ];
    }
}
