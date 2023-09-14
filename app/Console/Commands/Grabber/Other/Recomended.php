<?php

namespace App\Console\Commands\Grabber\Other;

use App\Events\QueueEvent;
use App\Http\Controllers\Backend\Queue\WorkerController;
use App\Models\Queue;
use Illuminate\Console\Command;

class Recomended extends Command
{
    protected $signature = 'grabber:other-recomended {queue_id}';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $queue_id = $this->argument('queue_id');

        $worker = new WorkerController;
        $worker = $worker->other($queue_id, 'recomended');

        if($worker){
            $queue = Queue::find($queue_id);
            $queue->status = 2;
            if($queue->save()){
                QueueEvent::dispatch('update', $queue);
            }
        }
    }
}
