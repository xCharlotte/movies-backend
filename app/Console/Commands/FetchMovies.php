<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\MovieRepository;
use App\Services\MovieService;

class FetchMovies extends Command
{
    private $default_language = 'nl';
    private $default_total_pages = 20;
   
    private $movieRepository;
    private $movieConnection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the latests now playing movies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        MovieRepository $movieRepository, 
        MovieService $movieConnection
    ) {
        parent::__construct();

        $this->movieRepository = $movieRepository;
        $this->movieConnection = $movieConnection;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info($this->description);

        for ($page = 1; $page <= $this->default_total_pages; $page++) {
            $response = $this->movieConnection->getNowPlayingMovies($this->default_language, $page);
            
            foreach($response as $movie) {
                // Exclude chinese titled movies 
                if (preg_match('/^[a-zA-Z0-9\s\.,!\'"\(\)]+$/u', $movie['title'])) {
                    $this->movieRepository->store($movie);
                }
            }
        }

        $this->info("Imported now playing movies into the database.");
    }
}
