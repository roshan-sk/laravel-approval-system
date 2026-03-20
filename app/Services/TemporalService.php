<?php

namespace App\Services;

use Temporal\Client\WorkflowClient;
use Temporal\Client\WorkflowOptions;
use Temporal\Client\GRPC\ServiceClient;
use App\Temporal\Workflows\RequestWorkflowInterface;

class TemporalService
{
    protected $client;

    public function __construct()
    {
        $serviceClient = ServiceClient::create('localhost:7233');
        $this->client = WorkflowClient::create($serviceClient);
    }

    public function startWorkflow($requestId)
    {
        $workflowId = "pr-" . $requestId;

        $workflow = $this->client->newWorkflowStub(
            RequestWorkflowInterface::class,
            WorkflowOptions::new()
                ->withWorkflowId($workflowId)
                ->withTaskQueue('request-queue')
        );

        $this->client->start($workflow, $requestId);

        return $workflowId;
    }

    // Send Signal
    public function sendSignal($workflowId, $action)
    {
        $workflow = $this->client->newRunningWorkflowStub(
            RequestWorkflowInterface::class,
            $workflowId
        );

        if ($action === 'approve') {
            $workflow->approve();
        } else {
            $workflow->reject();
        }
    }
}