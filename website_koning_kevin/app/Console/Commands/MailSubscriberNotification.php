<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Project;
use App\Mail\MailSubscriberNotification as sendmail;
use Carbon\Carbon;
use App\Mail\UserAcceptedForProject;

class MailSubscriberNotification extends Command
{

    protected $signature = 'mail:subscriberNotification';


    protected $description = 'Command description';

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
//        $projects = DB::select(' SELECT * FROM `projects`p
//                                INNER JOIN project_user pu
//                                ON pu.project_id = p.id
//                                INNER JOIN users u
//                                ON u.id = pu.user_id
//                                WHERE pu.is_accepted = 0');

        

        $projects =Project::with('users')->whereHas('accepting_users')->where('created_at', '>=', Carbon::today()->toDateString())->get();
        if (count($projects)) {
            Mail::to('info@koningkevin.be')->send(new sendmail($projects));
        }

        $projects_user =Project::with('users')->whereHas('users_accepted')->where('created_at', '>=', Carbon::today()->toDateString())->get();
       foreach ($projects_user as $project_user){
           foreach ($project_user->users as $user){
               Mail::to($user->email)->send(new UserAcceptedForProject($project_user->name,$user));
           }
//              
       }


        echo 'send';
    }
}
