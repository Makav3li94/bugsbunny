<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class HandleGhosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handle:ghosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where([['authStatus',0],['username','']])->get();
        foreach ($users as $user){
            $user->notes()->delete();
            $user->smses()->delete();
            $user->delete();
        }
    }
}
