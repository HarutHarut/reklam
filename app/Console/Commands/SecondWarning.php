<?php

namespace App\Console\Commands;

use App\Models\MaliOglasi;
use App\Services\EmailCreateService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SecondWarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'second_warning';

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
        $warningDate = Carbon::now();

        try {
            $listings = MaliOglasi::whereBetween('datum_poteka', [ date('Y-m-d H:i:s', strtotime($warningDate)), date('Y-m-d H:i:s', strtotime($warningDate->addHour(48)))])
                ->whereNotNull('warning_sent')
                ->where('warning_email_count', '!=', 2)
                ->get();
//dd($listings);
            foreach ($listings as $listing) {
                $email = $listing->customer->user->email;

                if($listing->customer->id == config('constants.nonLoggedUser')){
                    $email = $listing->maliOglasiKontakts[0]->kontakt_email;
                }

                $view = 'emails.warningSent';
                $viewData = [
                    'subject' => "Warning Sent",
                    'email' => $email,
                    'listing' => $listing,
                    'hours' => 48,
                ];
                EmailCreateService::create(
                    $listing->customer->user->id,
                    $email,
                    $viewData['subject'],
                    view($view, $viewData)->render(),
                    'emails.warningSent',
                    config('constants.email_type.warning_sent')
                );

                $listing->warning_sent = date('Y-m-d H:i:s', strtotime($warningDate));
                $listing->warning_email_count = 2;
                $listing->save();
            }

        }catch (\Exception $e){
            dd($e->getMessage());
        }
        return 0;
    }
}
