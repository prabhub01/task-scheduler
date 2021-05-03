<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class sendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically send email if the domain date is expired';

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
    $today_date = Carbon::now();     //getting today's date
    $users = User::where('end_date', '<', $today_date)->get(); //get the expired users data

    foreach($users as $clients){
        Mail::raw(" Dear {$clients->client_name},
            Your Domain Subscription has expired on {$clients->end_date}. Please renew it soon.

            Thank you !", function($message) use ($clients)
            {
            $message->from('domain@pndc.com');
            $message->to($clients->client_email)->subject('Domain Expired');
            });
            }
        $this->info('Mails sent to all the clients whose domain is expired');

       //sending email if expirary date is 5 to 10 days away
    // $data = User::all();
    // foreach($data as $clients){
    //       $today_date = Carbon::now();
    //       $data_difference = $today_date->diffInDays($data->end_date, false);
    //       echo $data_difference;
    //     if($data_difference == 10){
    //                 Mail::raw(" Dear {$clients->client_name},
    //                     Your Domain Subscription will expire in 10 days. Please renew it soon.

    //                     Thank you !", function($message) use ($clients)
    //                     {
    //                     $message->from('domain@pndc.com');
    //                     $message->to($clients->client_email)->subject('Domain Expired');
    //                     });
    //                 $this->info('Mails sent to all the clients whose domain will expire in 10 days');
    //         }
    //         elseif($data_difference == 5)
    //         {
    //             Mail::raw(" Dear {$clients->client_name},
    //             Your Domain Subscription will expire in 5 days. Please renew it soon.

    //             Thank you !", function($message) use ($clients)
    //             {
    //             $message->from('domain@pndc.com');
    //             $message->to($clients->client_email)->subject('Domain Expired');
    //             });
    //         $this->info('Mails sent to all the clients whose domain will expire in 5 days');
    //     }
    //     }
    }
}
