<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        $query = "
            SELECT *
            FROM users
            WHERE role != 'Admin'
        ";

        $user = DB::select($query);

        return view('pages.user.data_pegawai', compact(['user']));
    }

    public function delete_data($id) {
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect('/data-pegawai');
    }

    public function add_view() {
        return view('pages.user.adddata');
    }

    public function add_action(Request $request) {
       

        $data = [
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'role'      => 'Pegawai',
            'password'  => $request->password
        ];
        // dd($data);

        User::create($data);


        return redirect('/data-pegawai');
        
    }


}
