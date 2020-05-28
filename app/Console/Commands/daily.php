<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class daily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clean db ';

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
        if( DB::table('orders')-> where('accepted' =='0') ){
            DB::table('orders')->where('created_at', '<=', Carbon::now()->subDay())->update(['refused' => '1' ]);

    }
    }
}
