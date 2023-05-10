<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TicketCloser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:closer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Closes open state tickets on certain elapsed time after updated_at column is not being changed';

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
        $days=config('constants.constants.ticket.close-time');
        $tickets = Ticket::where([
            ['status', '1'],
            ['updated_at', '>=', Carbon::now()->subDays($days)->toDateTimeString()]
        ])->get();
        foreach ($tickets as $ticket):
            $ticket->update(['status' => '0']);
            if ($ticket->faqs()
                    ->where('reply', null)
                    ->orWhere('reply', '')
                    ->get()
                    ->count() > 0) {
                $ticket->update(['answer' => '2']);
                $ticket->faqs()
                    ->where('reply', null)
                    ->orWhere('reply', '')
                    ->update(['reply' => 'مورد رسیدگی شد.', 'seen' => '2']);
            }
        endforeach;
    }
}
