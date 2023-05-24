<?php

namespace App\Console\Commands;

use App\Models\Sms;
use App\Traits\SmsableMokhaberat;
use Illuminate\Console\Command;
use SoapClient;
class CheckSmsStatus extends Command
{
    use SmsableMokhaberat;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:hour';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks Sms delivery status 30 minute after send';

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
        $this->setKeys();
        ini_set("soap.wsdl_cache_enabled", "0");
        $fast_url = config('constants.constants.sms.mokhaberat.fast_url');
        $client = new SoapClient($fast_url);
        $smses = Sms::where('status', 0)->whereNotNull('bulk_id')->get();
        foreach ($smses as $sms) {
            $message = $client->GetDelivery('isbug','isbug',$sms->bulk_id);
            $message = explode(':',$message);
            $status = substr($message[1], 0, -2) ;
            if ( $status == "delivered" ){
                $sms->update(['status' => 1]);
            }elseif ($status == "discarded"){
                $sms->update(['status' => 2]);
            }elseif($status == 'failed'){
                $sms->update(['status' => 3]);
            }
        }
    }
}
