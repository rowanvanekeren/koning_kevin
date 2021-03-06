<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
Use App\Category;
Use App\Role;
Use App\Tag;
use Auth;
use PhpParser\Comment\Doc;
use App\Project;
use App\ProjectDocument;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;


class Api_file_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin', ['only' => 'delete_file']);
//        ['except' => 'get_all_files']
    }

    public function delete_file_from_project($file_id,$project_id){

        return 'delete';
    }

    public function get_all_files()
    {
        $file = [];
        $get_all_categories = Category::all();
        foreach ($get_all_categories as $key => $category) {
            $files = $category->documents()->get();
            if (count($files)) {
                $file[$key]['category'] = $category;
                $file[$key]['files']['all'] = $files;
//                foreach ($files as $index => $value) {
//                    $file[$key]['files']['roles'] = $value->roles()->get();
//                    $file[$key]['files']['tags'] = $value->tags()->get();
//                }
            }
        }
        return $file;
    }

    public function get_categories()
    {
        $file = [];
        $get_all_categories = Category::all();
        foreach ($get_all_categories as $key => $category) {
            $files = $category->documents()->get();
            if (count($files)) {
                array_push($file, $category);
            }
        }
        return $file;
    }

    public function get_all_files_for_category($id)
    {
        $category = Category::find($id);
        return $category->documents()->get();
    }


    public function delete_file(Request $request)
    {
        if (Document::find($request->id)->delete()) {
            return array('success' => "Document gewist",'id'=>$request->category_id);
        };
        return array('error' => "Er ging iets fout, probeer later nog eens");
    }

    public function file_info($id)
    {
        if (Document::find($id)) {
            $file = [];
            $find_file = Document::find($id);
            $file['file'] = $find_file;
            $file['categories'] = $find_file->categories()->get();
            $file['roles'] = $find_file->roles()->get();
            $file['tags'] = $find_file->tags()->get();
            return $file;
        } else {
            array('error' => "Er ging iets fout, probeer later nog eens");
        }
    }

    public function get_all_files_search()
    {
        return Document::with('categories', 'roles', 'tags')->get();
    }

    public function get_files_belongs_to_user()
    {
        $files = [];
        $get_roles = Auth::user()->roles()->get();
        foreach ($get_roles as $key => $value) {
            $files[$key]['files'] = $value->documents()->get();
            $files[$key]['role'] = $value;
        }
        return $files;
    }

    public function get_files_project()
    {
        return array('success' => "get all file for projects");
    }

    public function get_all_files_by_search_query(Request $request)
    {

        $title = $request->string;
        $description = $request->string;
        $category = $request->category;
        $role = $request->role;

        $files = array('error' => 'Geen zoekopdracht ingevuld');
        if ($title == "" && $category == "" && $role == "") {
            return $files;
        }

        if ($category != "" && $role != "") {
            $files = Document::with('categories', 'roles')->whereHas('categories', function ($q) use ($category) {
                $q->where('type', $category);
            })->whereHas('roles', function ($q) use ($role) {
                $q->where('type', $role);
            });
            if ($title != "") {
                $files->where('title', 'like', '%' . $title . '%');
            }
            return $files->get();
        }

        if ($category != "") {
            $files = Document::with('categories', 'roles')->whereHas('categories', function ($q) use ($category) {
                $q->where('type', $category);
            });
            if ($title != "") {
                $files->where('title', 'like', '%' . $title . '%');
            }
            return $files->get();
        }
        if ($role != "") {

            $files = Document::with('categories', 'roles')->whereHas('roles', function ($q) use ($role) {
                $q->where('type', $role);
            });
            if ($title != "") {
                $files->where('title', 'like', '%' . $title . '%');
            }
            return $files->get();
        }
        if ($title != "") {
            $files = Document::with('categories', 'roles', 'tags')->where('title', 'like', '%' . $title . '%')
                ->orWhere('description', 'like', '%' . $description . '%')->orWhereHas('tags', function ($q) use ($title) {
                    $q->where('type', 'LIKE', '%' . $title . '%');
                });
        }


        return $files->get();
    }

    public function test(Request $request)
    {
//        return $projects =Project::with('users')->whereHas('users_accepted')->where('created_at', '>=', Carbon::today()->toDateString())->get();




        return Auth::user()->roles()->get();

        $file = [];
        $get_all_categories = Category::all();
        foreach ($get_all_categories as $key => $category) {
            $files = $category->documents()->get();
            if (count($files)) {
                array_push($file, $category);
            }
        }

        return $file;







        $title = 'a';
        $description = '';
        $category = '';
        $role = '';

        $files = array('error' => 'Geen zoekopdracht ingevuld');
        if ($title == "" && $category == "" && $role == "") {
            return $files;
        }

        if ($category != "" && $role != "") {
            $files = Document::with('categories', 'roles')->whereHas('categories', function ($q) use ($category) {
                $q->where('type', $category);
            })->whereHas('roles', function ($q) use ($role) {
                $q->where('type', $role);
            });
            if ($title != "") {
                $files->where('title', 'like', '%' . $title . '%');
            }
            return $files->get();
        }

        if ($category != "") {
            $files = Document::with('categories', 'roles')->whereHas('categories', function ($q) use ($category) {
                $q->where('type', $category);
            });
            if ($title != "") {
                $files->where('title', 'like', '%' . $title . '%');
            }
            return $files->get();
        }
        if ($role != "") {

            $files = Document::with('categories', 'roles')->whereHas('roles', function ($q) use ($role) {
                $q->where('type', $role);
            });
            if ($title != "") {
                $files->where('title', 'like', '%' . $title . '%');
            }
            return $files->get();
        }
        if ($title != "") {
            $files = Document::with('categories', 'roles', 'tags')->where('title', 'like', '%' . $title . '%')
                ->orWhere('description', 'like', '%' . $description . '%')->orWhereHas('tags', function ($q) use ($title) {
                    $q->where('type', 'LIKE', '%' . $title . '%');
                });
        }


        return $files->get();




























        if (isset($request->mail) && $request->mail==1 ){
        $users = User::where('is_active', 0)->where('created_at', '>=', Carbon::today()->toDateString())->get();
        if (count($users)) {
            return view('email.inactive_users_notification', ['users' => $users]);
        }
        }
        if (isset($request->mail) && $request->mail==2){

            $projects =Project::with('users')->whereHas('accepting_users')->where('created_at', '>=', Carbon::today()->toDateString())->get();
            if (count($projects)) {
                return view('email.Mail_Subscriber_Notification', ['projects' => $projects]);
            }
        }

        if (isset($request->mail) && $request->mail==3){

            $projects_user =Project::with('users')->whereHas('users_accepted')->where('created_at', '>=', Carbon::today()->toDateString())->get();
            foreach ($projects_user as $project_user){
                foreach ($project_user->users as $user){
                   
                    return view('email.User_accepted_for_project', ['project' => $project_user->name,'user'=>$user]);
                }
//
            }
        }

        return 'er is geen test data maak gebreukets aan voor dat ze geaccepteerd zijn ook meld je aan voor projecten';
    }

}
