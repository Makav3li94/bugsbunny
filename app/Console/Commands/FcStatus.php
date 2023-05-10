<?php

namespace App\Console\Commands;

use App\Models\FinancialClaims;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FcStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fc:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change status for financial claims based on date';

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
        $fcs = FinancialClaims::where([
            ['financial_claims_category_id', 2],
            ['status', 1], ["due_date", Carbon::today()]
        ])->get();
        foreach ($fcs as $fc) {
            $user = User::find($fc->user_id);
            Wallet::create([
                'parent_id' => 0,
                'user_id' => $user->id,
                'amount' => $fc->cash,
                'action' => 1,
            ]);
            $fc->update(['status' => 5]);
        }

    }
}
