<?php

namespace Modules\OpportunitiesManagement\app\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Modules\OpportunitiesManagement\app\Models\Opportunity;

class OpportunityChangeStatusRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function authorize()
    {
        return Gate::authorize('changeStatus', request()->route('opportunity'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => ['required', Rule::in(array_keys(Opportunity::$statuses))],
        ];
    }
}
