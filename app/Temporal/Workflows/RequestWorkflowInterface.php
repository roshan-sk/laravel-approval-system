<?php

namespace App\Temporal\Workflows;

use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;
use Temporal\Workflow\SignalMethod;

#[WorkflowInterface]
interface RequestWorkflowInterface
{
    #[WorkflowMethod]
    public function handle($requestId);

    #[SignalMethod]
    public function approve();

    #[SignalMethod]
    public function reject();
}