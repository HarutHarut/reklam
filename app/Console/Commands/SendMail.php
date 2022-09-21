<?php

namespace App\Console\Commands;

use App\Models\Emails;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     *
     */
    public function handle()
    {
        $emails = Emails::query()
            ->where('status', '=', 0)
            ->where('attempts', '<', 3)
            ->get();

        if (count($emails)) {
            foreach ($emails as $email) {
                $schedule_date = date('Y-m-d h:i:s');
//                try {
                    Mail::send([], [], function (Message $message) use ($email) {
                        $message->to($email->to_email)
                            ->subject($email->subject)
//                            ->setBody($email->content, 'text/html')
                            ->html($email->content);


                        if ($email->attachment) {
                            $message->attach($email->attachment);
                        }
                    });
                    $email->date_sent = date('Y-m-d h:i:s');
                    $email->status = 1;
//                } catch (\Throwable $e) {
////                    dd($e->getMessage());
//                }
                $email->attempts++;
                $email->schedule_date = $schedule_date;
                $email->save();
            }
        }
    }
}
