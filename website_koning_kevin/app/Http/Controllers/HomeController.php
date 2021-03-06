<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\AdministrativeDetail;
use App\Project;
use App\Role;
use Illuminate\Support\Facades\Session;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSubscriberNotification as sendmail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //except => name_function  voor uitzonderingen
        $this->middleware('is_active', ['except' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public  function contact(){
        return view('contact.contact');
    }
    public  function send_contact(Request $request){
        $this->validate($request,[
            'title'=>"required|max:255",
            'bericht'=>"required|max:1000"
        ]);
        Mail::to('info@koningkevin.be')->send(new ContactMail(Auth::user()->first_name,$request->title,$request->bericht));
        Session::flash('success', 'Je bericht is goed aangekomen bij Koning Kevin. Binnen de week mag je een antwoord verwachten.');
        return redirect('/contact');
    }
    public function index()
    {
        date_default_timezone_set('Europe/Brussels');
        
        $today = date('Y-m-d H:i:s');
        //get all active projects where the startdate is after the current date
        $projects = Project::where('active', 1)->where('start', '>=', $today)->orderBy('start')->get();
        //dd($projects[0]->accepting_users);
        //get all the projects which the currently logged in user has been accepted for
        $my_projects = Project::where('active', 1)->where('start', '>=', $today)->orderBy('start')->whereHas('users', function ($query) {
            $query->where('users.id', Auth::user()->id);
            $query->where('is_accepted', 1);
        })->get();
        //dd($my_projects);
        $inactive_users = User::where('is_active', 0)->get();
        $roles = Role::all();
        return view('dashboard', ['projects' => $projects, 'my_projects' => $my_projects, 'inactive_users' => $inactive_users, 'roles' => $roles]);
    }

    public function project_overview() {
        $today = date('Y-m-d H:i:s');
        $projects = Project::where('active', 1)->where('start', '>=', $today)->orderBy('start')->get();
        return view('projects_overview', ['projects' => $projects]);
    }

    public function profile_info($id = null)
    {

        if (!$id) {
            $id = Auth::user()->id;
        }
        $user = User::find($id);
        $roles = Role::all();

        
        return view('profile_info', ['user' => $user, 'roles' => $roles]);
    }
    
    public function edit_profile(Request $request) {
        //dd($request);
        $user = User::find($request->user_id);
        
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:1000',
            'email'     => 'required|email',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'image' => 'image|mimes:jpeg,jpg,png|max:1000',
        ]);

        $allowed_extensions = ["jpeg", "png"];

        if (isset($request->image)) {

            //check whether file extension is valid
            if (in_array($request->image->guessClientExtension(), $allowed_extensions)) {

                //create new file name
                $new_file_name = time() . $request->first_name."_".$request->last_name . "." . $request->image->guessClientExtension();
                $request->image->move(base_path() . '/public/images/profile_pictures/', $new_file_name);
                $user->url = $new_file_name;
            }
            else {

                // not ok return to add project view with error
            }
        }
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->birth_date = $request->birth_date;
        $user->birth_place = $request->birth_place;
        /*
        $user->job = $request->job;
        $user->job_function = $request->job_function;
        */
        
        $user->administrative_details->bank_account_number = $request->bank_account;
        $user->administrative_details->national_insurance_number = $request->national_insurance;
        $user->administrative_details->identity_number = $request->identity;
        
        $user->save();
        $user->administrative_details->save();
        
        if($request->new_roles) {
            $user->roles()->detach();
            foreach($request->new_roles as $role) {
                $user->roles()->attach($role);
            }
        }
        
        
        return redirect('/profiel/' .$request->user_id)->with('success_message', 'Profiel werd succesvol aangepast');
    }
    
    
    public function project_info($id) {
        $project = Project::where('id', $id)->first();
        $user = $project->users()->where('users.id', Auth::user()->id)->first();
        //dd($project->documents);
        $volunteered = false;
        $role = false;
        if($user) {
            $volunteered = true;
            //if the user already signed up for the project, check if he she is accepted and with which role
            if($user->pivot->is_accepted) {
                $role = Role::where('id', $user->pivot->role_id)->pluck('type')->first();
                //dd("this user was accepted with the role: " . $role);
            }
        }
        else {
            //dd("no user found");
        }
        return view('project_info', ['project' => $project, 'volunteered' => $volunteered, 'role' => $role]);
    }
    
    public function volunteer($id) {
        $user = Auth::user();
        $user->projects()->attach($id);
        $project = Project::find($id);
        
        Mail::to('info@koningkevin.be')->send(new sendmail($project,$user));
        return redirect('/project_info/'.$id)->with('success_message', 'Bedankt om je aan te melden ! Zodra een administrator je geaccepteerd heeft, komt dit project bij jouw persoonlijke overzicht.');
    }
    
    
    public function volunteers_overview() {
        $volunteers = User::where('is_active', 1)->orderBy('last_name')->paginate(25);
        //dd($volunteers);
        //dd($volunteers[2]->accepted_projects);
        return view('volunteers_overview', ['volunteers' => $volunteers]);
    }
    
    public function search_volunteers(Request $request) {
        $search = strtolower($request->search);
        $volunteers = User::where('is_active', 1)
            ->where(function($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            })
            ->orderBy('last_name')->paginate(25)->appends(['search' => $request->search]);
        return view('volunteers_overview', ['volunteers' => $volunteers]);
    }
    
    
}
