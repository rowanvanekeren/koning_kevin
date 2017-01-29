<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InactiveUsersNotification;
use Carbon\Carbon;
class MailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:inactiveUsersNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Keep admin up to date with new volunteers';

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
        $users = User::where('is_active', 0)->where('created_at', '>=', Carbon::today()->toDateString())->get();
        if(count($users)){
            Mail::to('info@koningkevin.be')->send(new InactiveUsersNotification($users));
        }
    }
}
