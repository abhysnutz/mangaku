<?php

namespace App\Console\Commands;

use App\Events\QueueEvent;
use App\Models\Queue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

class Grabber extends Command
{
    protected $signature = 'grabber';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $progress = Queue::where('status', 1)->first();
        if(!$progress){
            $queue = Queue::with('grabber')->where('status', 0)->first();
            
            if($queue){
                $queue->status = 1;
                $queue->progressed_at = NOW();

                if($queue->save()){
                    QueueEvent::dispatch('update', $queue);
                    if($queue->grabber->id == 6){
                        Artisan::call($queue->grabber->artisan, ['queue_id' => $queue->id, 'comic_id' => $queue->ref_id]);
                    }else if($queue->grabber->id == 7){
                        Artisan::call($queue->grabber->artisan, ['queue_id' => $queue->id, 'chapter_id' => $queue->ref_id]);
                    }else{
                        Artisan::call($queue->grabber->artisan, ['queue_id' => $queue->id]);
                    }
                }
            }
            else{
                $create = Queue::create([
                    'grabber_id' => 1,
                    'title' => 'Grab Latest Comic',
                    'status' => 0,
                ]);

                if($create){
                    $queue = Queue::with('grabber')->where('id', $create->id)->first();
                    QueueEvent::dispatch('store', $queue);
                }
            }
        }else{
            $audit = $progress->audits->first();
            $now = Carbon::now();
            $end_date = ($audit) ? Carbon::parse($audit->created_at) : Carbon::parse($progress->created_at);

            $diff = $now->diffInMinutes($end_date);
            if($diff > 10){
                $queue = Queue::find($progress->id)->update(['status' => 0]);
                QueueEvent::dispatch('update', $queue);
            }
        }
    }
}