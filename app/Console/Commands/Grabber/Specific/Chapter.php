<?php

namespace App\Console\Commands\Grabber\Specific;

use App\Events\QueueEvent;
use App\Http\Controllers\Backend\Queue\WorkerController;
use App\Models\Chapter as ModelsChapter;
use App\Models\Queue;
use Illuminate\Console\Command;

class Chapter extends Command
{
    protected $signature = 'grabber:spec-chapter {queue_id} {chapter_id}';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $queue_id = $this->argument('queue_id');
        $chapter_id = $this->argument('chapter_id');

        $worker = new WorkerController;
        $worker = $worker->image($queue_id, ModelsChapter::find($chapter_id));

        if($worker){
            $queue = Queue::find($queue_id);
            $queue->status = 2;
            if($queue->save()){
                QueueEvent::dispatch('update', $queue);
            }
        }
    }
}
