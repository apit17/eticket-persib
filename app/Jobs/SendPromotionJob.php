<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendPromotionJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $message = array();

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->message;
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                Mail::send('email.sendPromotion',$value, function ($message) use ($value) {
                    $message->subject("Schedule - Pertandingan Selanjutnya [Anda tidak perlu membalas email ini]");
                    $message->from('apit.gilang@appschef.com');
                    $message->to($value['email']);
                });
            }
        }
    }
}
