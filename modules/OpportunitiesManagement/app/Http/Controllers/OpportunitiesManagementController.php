<?php

namespace Modules\OpportunitiesManagement\Http\Controllers;


use App\Http\Models\Enum;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Controller;
use Modules\OpportunitiesManagement\app\Helpers\Helper;
use Modules\OpportunitiesManagement\app\Http\Requests\OpportunityRequests;
use Modules\OpportunitiesManagement\app\Models\Opportunity;

class OpportunitiesManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        $query = Opportunity::query();
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('related_customer', 'like', "%{$search}%");
            });
        }

        $filters = [
            'status' => request('status'),
            'title' => request('title'),
            'related_customer' => request('related_customer'),
        ];

        foreach ($filters as $key => $value) {
            $query->when($value, function ($q) use ($key, $value) {
                return $q->where($key, $value);
            });
        }

        $enumNames = Enum::getEnumNames();
        Helper::replaceEnum(['status' => Opportunity::$statuses]);
        return response()->json([
            'data' => new JsonResource($query->paginate(request('perPage') ?? 10)),
            'enumNames' => $enumNames,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(OpportunityRequests $opportunityRequests)
    {
        $args = $opportunityRequests->validated();
        $query = Opportunity::query()->create([
            'title' => $args['title'],
            'related_customer' => $args['related_customer'],
            'status' => Opportunity::$statuses['NEW'],
            'cost' => $args['cost'],
        ]);
        $args [] = ['created_by_id' => auth()->id,];
        $query->save();
        return response()->json([
            'success' => true,
            'message' => __('create was successful'),
        ], ['id' => $query->id]);
    }

    /**
     * Show the specified resource.
     */
    public function show(Opportunity $opportunity)
    {
        return $opportunity;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OpportunityRequests $opportunityRequests, Opportunity $opportunity)
    {
        $this->authorize('update', $opportunity);
        $args = $opportunityRequests->validated();
        $query = Opportunity::query()->update([
            'id' => $opportunity->id,
            'title' => $args['title'],
            'related_customer' => $args['related_customer'],
            'cost' => $args['cost'],
            'status' => $args['status'],
            'created_by_id' => $args['created_by_id'],
        ]);
        $query->save();
        return response()->json([
            'success' => true,
            'message' => __('update was successful'),
        ], ['id' => $query->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opportunity $opportunity)
    {
        $this->authorize('delete', $opportunity);
        $opportunity->delete();
        return response()->json([
            'success' => true,
            'message' => __('delete was successful'),
        ]);
    }

    public function changeStatus(OpportunityRequest $opportunityRequest, Opportunity $opportunity)
    {
        $this->authorize('changeStatus', $opportunity);
        $opportunity->update($opportunityRequest['status']);
        $opportunity->save();

        return response()->json(['success' => true, 'message' => __('Status updated successfully')]);
    }
}
