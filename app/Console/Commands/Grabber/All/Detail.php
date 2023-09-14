<?php

namespace App\Console\Commands\Grabber\All;

use Illuminate\Console\Command;
use App\Events\QueueEvent;
use App\Http\Controllers\Backend\Queue\WorkerController;
use App\Models\Queue;

class Detail extends Command
{
    protected $signature = 'grabber:all-detail {queue_id}';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $queue_id = $this->argument('queue_id');

        $worker = new WorkerController;
        $worker = $worker->allDetail($queue_id);

        if($worker){
            $queue = Queue::find($queue_id);
            $queue->status = 2;
            if($queue->save()){
                QueueEvent::dispatch('update', $queue);
            }
        }
    }
}