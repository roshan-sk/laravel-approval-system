<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use App\Mail\RequestCreatedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Services\TemporalService;

class RequestController extends Controller
{
    public function create(Request $req, TemporalService $temporal)
    {
        $request = PurchaseRequest::create([
            'item' => $req->item,
            'justification' => $req->justification,
            'requested_by' => $req->user_id,
            'status' => 'pending'
        ]);

        $request->load('requester');

        $workflowId = $temporal->startWorkflow($request->id);

        $request->update([
            'workflow_id' => $workflowId
        ]);


        return response()->json([
            'message' => 'Request created',
            'data' => $request
        ]);
    }


    public function approve($id, TemporalService $temporal)
    {
        $request = PurchaseRequest::findOrFail($id);

        $temporal->sendSignal($request->workflow_id, 'approve');

        return view('requests.approved', compact('request'));
    }


    public function reject($id, TemporalService $temporal)
    {
        $request = PurchaseRequest::findOrFail($id);

        $temporal->sendSignal($request->workflow_id, 'reject');

        return view('requests.reject', compact('request'));
    }


    public function index()
    {
        $requests = PurchaseRequest::with(['requester', 'actionUser'])->get();

        return response()->json([
            'message' => 'All requests fetched',
            'data' => $requests
        ]);
    }

    public function show($id)
    {
        $request = PurchaseRequest::with(['requester', 'actionUser'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Request details',
            'data' => $request
        ]);
    }
}
