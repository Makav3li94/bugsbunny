<?php

namespace App\Jobs;

use App\Traits\SmsableMokhaberat;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendBatchSmsMokhaberat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SmsableMokhaberat;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $mobile;
    public $fromNumber;
    public $message;
    public $smsId ;

    public function __construct($mobile, $fromNumber, $message,$smsId)
    {
        $this->mobile = [$mobile];
        $this->fromNumber = $fromNumber;
        $this->message = $message;
        $this->smsId =$smsId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->setKeys();
        $this->sendOrdinarySmsMokhaberat($this->mobile, $this->message, $this->fromNumber,$this->smsId);
    }

}
