<?php

namespace App\Console\Commands;

use App\RestApi;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name {ipAddress}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mendaftar api client';

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
        $ip = $this->argument('ipAddress');
        $secret = Str::random(120);
        RestApi::create([
            'client' => $ip,
            'secret' => $secret,
        ]);

        $this->info('Kode rahasia: ' . $secret);
    }
}
