<?php

namespace App\Temporal\Activities;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface]
interface RequestActivityInterface
{
    #[ActivityMethod(name: "sendApprovalEmail")]
    public function sendApprovalEmail($requestId);

    #[ActivityMethod(name: "markApproved")]
    public function markApproved($requestId);

    #[ActivityMethod(name: "markRejected")]
    public function markRejected($requestId);
}