<?php

namespace Modules\OpportunitiesManagement\app\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class OpportunityUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function authorize()
    {
        return Gate::authorize('update', request()->route('opportunity'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'related_customer' => 'nullable|string|max:255',
            'cost' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
