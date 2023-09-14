<?php

namespace Database\Seeders;

use App\Models\Grabber;
use Illuminate\Database\Seeder;

class GrabberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grabber::create([ 'title' => 'Grab New Comic',  'artisan' => 'grabber:latest']);
        Grabber::create([ 'title' => 'Grab All Comic',  'artisan' => 'grabber:all-comic']);
        Grabber::create([ 'title' => 'Grab All Detail', 'artisan' => 'grabber:all-detail']);
        Grabber::create([ 'title' => 'Grab All Chapter','artisan' => 'grabber:all-chapter']);
        Grabber::create([ 'title' => 'Grab All Image',  'artisan' => 'grabber:all-image']);
        
        // SPEC
        Grabber::create([ 'title' => 'Grab Comic',  'artisan' => 'grabber:spec-comic']);
        Grabber::create([ 'title' => 'Grab Chapter','artisan' => 'grabber:spec-chapter']);
    }
}
