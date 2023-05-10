<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TxStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tx:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change tx status based on date';

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
        $txs = Transaction::where([
            ['pc_type', 1],
            ['status', 1], ["due_date", Carbon::today()]
        ])->update(['status' => 4]);
    }
}
