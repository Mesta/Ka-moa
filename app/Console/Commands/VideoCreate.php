<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VideoCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:create {title? : Video title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a video description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $title      = null;
        $date       = null;
        $realisator = null;

        // Get title from input or optionnal parameter
        $title = $this->argument('title');
        while($title === null) {
            $title = $this->ask('What is the video title?');
        }

        // Get realisator from input
        while($realisator === null){
            $realisator = $this->ask('Who is the video realisator? (necessary)');
        }

        // Get date from input
        while($date === null){
            $date = $this->ask('What is release date of the video? (default: today)');
        }
    }
}
