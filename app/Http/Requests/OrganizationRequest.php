<?php

namespace App\Http\Requests;

use App\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:5|max:100|confirmed',
            'type' => [
                'required',
                Rule::in(Organization::TYPE_BRANCH, Organization::TYPE_PERSONAL)
            ],
            'size' => 'required|integer',
            'number_branch' => 'required|integer',
            'settlement_month' => 'required|numeric',
        ];
    }
}
