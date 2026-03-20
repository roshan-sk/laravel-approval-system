<?php

namespace App\Temporal\Activities;

use App\Models\PurchaseRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestCreatedMail;

class RequestActivity implements RequestActivityInterface
{
    public function sendApprovalEmail($requestId)
    {
        $request = PurchaseRequest::with('requester')->find($requestId);

        // $manager = User::where('role', 'manager')->first();

        // if ($manager) {
        //     Mail::to($manager->email)->send(new RequestCreatedMail($request));
        // }

        Mail::to('roshansk126@gmail.com')->send(new RequestCreatedMail($request));
    }

    public function markApproved($requestId)
    {
        \Log::info("✅ Approved: $requestId");

        PurchaseRequest::where('id', $requestId)->update([
            'status' => 'approved',
            'action_by' => 1
        ]);
    }

    public function markRejected($requestId)
    {
        \Log::info("❌ Rejected: $requestId");

        PurchaseRequest::where('id', $requestId)->update([
            'status' => 'rejected',
            'action_by' => 1
        ]);
    }
}