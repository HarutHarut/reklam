<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_users';

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
        $customers = Customer::where('user_id', null)->get();
//        $customers = Customer::all();
        $userEmails = User::pluck('email');
        foreach ($customers as $customer){
            if(!in_array($customer->email_address, $userEmails->toArray())){
                $user = User::create([
                    'name' => $customer['username'],
                    'email' => $customer['email_address'],
                    'email_verified_at' => Carbon::now(),
                    'password' => $customer['password'],
                ]);
            }else{
                $user = User::where('email', $customer->email_address)->first();
            }

            $customer->user_id = $user->id;
//            $customer->user_id = null;
            $customer->save();
        }
//        dd($customers);
        return 0;
    }
}
