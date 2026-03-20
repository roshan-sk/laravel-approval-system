<?php

namespace App\Temporal\Workflows;

use Temporal\Workflow;
use App\Temporal\Activities\RequestActivityInterface;
use Temporal\Activity\ActivityOptions;


class RequestWorkflow implements RequestWorkflowInterface
{
    private bool $approved = false;
    private bool $rejected = false;

    public function handle($requestId)
    {
        $activity = Workflow::newActivityStub(
            RequestActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(\DateInterval::createFromDateString('1 minute'))
        );

        // Step 1: Send email
        yield $activity->sendApprovalEmail($requestId);

        // ✅ WAIT properly
        yield Workflow::await(fn () => $this->approved || $this->rejected);

        // ✅ CRITICAL FIX: loop until signal
        // while (!$this->approved && !$this->rejected) {
        //     Workflow::await(fn () => $this->approved || $this->rejected);
        // }

        // Step 2: Decision
        if ($this->approved) {
            yield $activity->markApproved($requestId);
        } else {
            yield $activity->markRejected($requestId);
        }
    }

    public function approve()
    {
        $this->approved = true;
    }

    public function reject()
    {
        $this->rejected = true;
    }
}