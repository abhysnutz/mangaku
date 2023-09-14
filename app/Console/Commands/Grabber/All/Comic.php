<?php

namespace App\Console\Commands\Grabber\All;

use App\Events\QueueEvent;
use App\Http\Controllers\Backend\Queue\WorkerController;
use App\Models\Queue;
use Illuminate\Console\Command;

class Comic extends Command
{
    protected $signature = 'grabber:all-comic {queue_id}';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $queue_id = $this->argument('queue_id');

        $worker = new WorkerController;
        $worker = $worker->allComic($queue_id);

        if($worker){
            $queue = Queue::find($queue_id);
            $queue->status = 2;
            if($queue->save()){
                QueueEvent::dispatch('update', $queue);
            }
        }
    }
}
