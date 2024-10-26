<?php

namespace Modules\OpportunitiesManagement\app\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Modules\OpportunitiesManagement\app\Models\Opportunity;

class OpportunityCreateRequests extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return \Illuminate\Auth\Access\Response
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
            'title' => 'required|string|max:255',
            'related_customer' => 'required|string|max:255',
            'cost' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.title.required'),
            'title.string' => trans('validation.title.string'),
            'title.max' => trans('validation.title.max'),

            'related_customer.required' => trans('validation.related_customer.required'),
            'related_customer.string' => trans('validation.related_customer.string'),
            'related_customer.max' => trans('validation.related_customer.max'),

            'cost.required' => trans('validation.cost.required'),
            'cost.numeric' => trans('validation.cost.numeric'),
            'cost.regex' => trans('validation.cost.regex'),
        ];
    }
}
