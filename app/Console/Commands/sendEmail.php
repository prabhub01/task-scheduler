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
    // echo $users;

    foreach($users as $clients){
        Mail::raw("Your Domain Subscription has expired!", function($message) use ($clients)
            {
            $message->from('domain@pndc.com');
            $message->to($clients->client_email)->subject('Domain Expired');
            });
            }
        $this->info('Domain Expired mails has been send successfully');
    }
    }
