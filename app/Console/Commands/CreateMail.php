<?php

namespace App\Console\Commands;

use App\Models\MaliOglasi;
use App\Models\MaliOglasiKontakt;
use App\Services\EmailCreateService;
use Illuminate\Console\Command;

class CreateMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:mail';

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
        $listings = MaliOglasi::where('user_id', config('constants.nonLoggedUser'))
            ->where('notify_expiration', 1)
            ->where('datum_poteka', '<=', now())
            ->get();
        if(count($listings)){
            foreach ($listings as $listing){
                $contact = MaliOglasiKontakt::where('listing_id', $listing->id)
                    ->where('send_email', 0)
                    ->first();

                if($contact){
                    $view = 'emails.notifyExpiration';
                    $viewData = [
                        'subject' => "Notify Expiration",
                        'email' => $contact->kontakt_email,
                    ];
                    EmailCreateService::create(
                        $contact->id,
                        $contact->kontakt_email,
                        $viewData['subject'],
                        view($view, $viewData)->render(),
                        'emails.notifyExpiration',
                        config('constants.email_type.notify_expiration')
                    );
                    $contact->send_email = 1;
                    $contact->save();
                }

            }
        }
        return 0;
    }
}
