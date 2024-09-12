<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        return view('backend.master');
    }

    public function AddPost() {
        return view('backend.add-post');
    }

    public function ListPost() {
        return view('backend.list-post');
    }

    // Add Logo
    public function addLogo() {
        return view('backend.add-logo');
    }

    public function addLogoSubmit(Request $request) {
        $file = $request->file('thumbnail');
        if(!empty($file)) {
            $thumbnail = $this->uploadFile($file);
            $author    = Auth::user()->id;
            $date      = date('Y-m-d h:i:s');

            //prepare insert to DB
            $logo = DB::table('logo')->insert([
                'thumbnail' => $thumbnail,
                'author'    => $author
            ]);
            if($logo) {
                $this->logActivity('Logo', 'Logo', 'Insert', $author, $date);
                return redirect('/admin/add-logo')->with('message', 'Post Inserted');
            }
        }
    }

    // List Logo
    public function listLogo() {
        $logo = DB::table('logo')
                    ->join('users', 'logo.author', 'users.id')
                    ->select('users.name', 'logo.*')
                    ->orderByDesc('logo.id')
                    ->get();
        return view('backend.list-logo',[
            'logo' => $logo
        ]);
    }

    // Update Logo
    public function updateLogo($id) {
        $logo = DB::table('logo')->find($id);
        return view('backend.update-logo',[
            'logo' => $logo
        ]);
    }

    public function updateLogoSubmit(Request $request) {
        $id = $request->id;
        $file = $request->file('thumbnail');
        if(!empty($file)) {
            $thumbnail = $this->uploadFile($file);
        }
        else {
            $thumbnail = $request->old_thumbnail;
        }

        $date = date('Y-m-d h:i:s');

        $logo = DB::table('logo')
                    ->where('id', $id)
                    ->update([
                        'thumbnail'  => $thumbnail,
                        'updated_at' => $date
                    ]);

        if($logo) {
            $this->logActivity('Logo','Logo', 'Update', Auth::user()->id, $date);
            return redirect('/admin/list-logo')->with('msg_update_success', 'Post Updated');
        }
    }

    // Remove Logo
    public function removeLogoSubmit(Request $request) {
        $date = date('Y-m-d h:i:s');
        $logo = DB::table('logo')->delete($request->id);
        if($logo) {
            $this->logActivity('Logo','Logo', 'Remove', Auth::user()->id, $date);
            return redirect('/admin/list-logo');
        }
    }


    //Log Activity
    public function listLogActivity() {
        $log = DB::table('log')
                    ->join('users', 'users.id', 'log.author')
                    ->select('users.name', 'log.*')
                    ->orderByDesc('log.id')
                    ->get();

        return view('backend.list-log',[
            'log' => $log
        ]);
    }

}
