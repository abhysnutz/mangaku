<?php

namespace App\Console\Commands\Grabber\Specific;

use App\Events\QueueEvent;
use App\Http\Controllers\Backend\Queue\WorkerController;
use App\Models\Comic\Comic as ModelsComic;
use App\Models\Queue;
use Illuminate\Console\Command;

class Comic extends Command
{
    protected $signature = 'grabber:spec-comic {queue_id} {comic_id}';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $queue_id = $this->argument('queue_id');
        $comic_id = $this->argument('comic_id');

        $worker = new WorkerController;
        $worker = $worker->comic($queue_id, ModelsComic::find($comic_id));

        if($worker){
            $queue = Queue::find($queue_id);
            $queue->status = 2;
            if($queue->save()){
                QueueEvent::dispatch('update', $queue);
            }
        }
    }
}
