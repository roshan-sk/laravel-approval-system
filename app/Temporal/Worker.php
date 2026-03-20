<?php

namespace App\Temporal;

use Temporal\WorkerFactory;
use Temporal\Client\GRPC\ServiceClient;

use App\Temporal\Workflows\RequestWorkflow;
use App\Temporal\Activities\RequestActivity;

class Worker
{
    public static function run()
    {
        // ✅ Create Service Client (connection to Temporal)
        $serviceClient = ServiceClient::create('localhost:7233');

        // ✅ Create Worker Factory (NEW WAY)
        $factory = WorkerFactory::create();

        // ✅ Create Worker with Task Queue
        $worker = $factory->newWorker('request-queue');

        // ✅ Register Workflow
        $worker->registerWorkflowTypes(
            RequestWorkflow::class
        );

        // ✅ Register Activities
        $worker->registerActivity(RequestActivity::class); 

        // ✅ Start Worker
        $factory->run();
    }
}