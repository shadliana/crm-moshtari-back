<?php

namespace Modules\OpportunitiesManagement\app\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\OpportunitiesManagement\app\Http\Requests\OpportunityChangeStatusRequest;
use Modules\OpportunitiesManagement\app\Http\Requests\OpportunityCreateRequests;
use Modules\OpportunitiesManagement\app\Http\Requests\OpportunityUpdateRequest;
use Modules\OpportunitiesManagement\app\Http\Resources\OpportunityResource;
use Modules\OpportunitiesManagement\app\Models\Opportunity;

class OpportunitiesManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Opportunity::query();
        if (request('search') && $search = $request->search) {
            $query = $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('related_customer', 'like', "%{$search}%");
            });
        }

        if(request('status')) {
            $query = $query->where("status", $request->status);
        }
        return new OpportunityResource($query->get());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(OpportunityCreateRequests $opportunityRequests)
    {
        $args = $opportunityRequests->validated();
        $query = Opportunity::query()->create([
            'title' => $args['title'],
            'related_customer' => $args['related_customer'],
            'status' => Opportunity::$statuses['NEW'],
            'cost' => $args['cost'],
            'created_by_id'=>auth()->id()
        ]);
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
    public function update(OpportunityUpdateRequest $opportunityRequests, Opportunity $opportunity)
    {
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
        Gate::authorize('delete', $opportunity);
        $opportunity->delete();
        return response()->json([
            'success' => true,
            'message' => __('delete was successful'),
        ]);
    }

    public function changeStatus(OpportunityChangeStatusRequest $opportunityRequest, Opportunity $opportunity)
    {
        $opportunity->update($opportunityRequest['status']);
        $opportunity->save();

        return response()->json(['success' => true, 'message' => __('Status updated successfully')]);
    }
}
