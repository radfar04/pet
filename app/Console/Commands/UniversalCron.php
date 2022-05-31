<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class UniversalCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:allemails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $arr = DB::table('emaillog')->select('user_id')->orderby('id')->get();
        $mail = new MailController;
        foreach($arr as $s){
            $mail->Universalemail($s->user_id);
        }
        return 0;
    }
}    
    
    
