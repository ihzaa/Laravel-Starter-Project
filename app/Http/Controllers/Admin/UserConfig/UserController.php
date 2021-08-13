<?php

namespace App\Http\Controllers\Admin\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = User::query();

            return datatables()->of($query)
            ->addColumn('action', function(){
                return '<a class="btn btn-sm btn-success" href=""><i class="far fa-eye"></i> view</a>';
            })
            ->make(true);
        }

        return view('admin.pages.user_configuration.user.index');
    }
}
