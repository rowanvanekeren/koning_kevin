<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\AdministrativeDetail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\InactiveUsersNotification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'last_name'=>'required|max:255',
            'address'=>'required|max:255',
            'city'=>'required|max:255',
            'country'=>'required|max:255',
            'gender'=>'required|max:255',
            'birth_date'=>'required|date|date_format:Y-m-d',
            'birth_place'=>'required|max:255',
            'readme'=>'required',
            'url'   => 'image|mimes:jpeg,jpg,png|max:1000',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $new_file_name = 'profielfoto.jpeg';
        
        //allowed extensions
        $allowed_extensions = ["jpeg", "png"];
        
        if (isset($data['url'])) {
            
            //check whether file extension is valid
            if (in_array($data['url']->guessClientExtension(), $allowed_extensions)) {
                
                //create new file name
                $new_file_name = time() . $data['name']."_".$data['last_name'] . "." . $data['url']->guessClientExtension();
                $data['url']->move(base_path() . '/public/images/profile_pictures/', $new_file_name);
            }
            else {

                // not ok return to add project view with error
            }
        }
        else {
            $new_file_name = "default_project_img.jpg";
        }
        
        
        $user = new User([
            'first_name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'last_name'=>$data['last_name'],
            'url'=>$new_file_name,
            'address'=>$data['address'],
            'city'=>$data['city'],
            'country'=>$data['country'],
            'gender'=>$data['gender'],
            'birth_date'=>$data['birth_date'],
            'birth_place'=>$data['birth_place'],
            'readme'=>$data['readme'],
        ]);
        
        $user->save();
        Mail::to('info@koningkevin.be')->send(new InactiveUsersNotification($user));
        $administrative_details = new AdministrativeDetail([
            'bank_account_number' => null,
            'national_insurance_number' => null,
            'identity_number' => null,
            'user_id'=> $user->id,
        ]);
        
        $administrative_details->save();

        //return redirect('/home');
        
        /*
        return User::create([
            'first_name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'last_name'=>$data['last_name'],
            'url'=>$new_file_name,
            'address'=>$data['address'],
            'city'=>$data['city'],
            'country'=>$data['country'],
            'job'=>$data['job'],
            'job_function'=>$data['job_function'],
            'gender'=>$data['gender'],
            'birth_date'=>$data['birth_date'],
            'birth_place'=>$data['birth_place'],
            'readme'=>$data['readme'],
            
        ]);*/
        
        return $user;



    }
}
