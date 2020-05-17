<?php

namespace App\Http\Controllers\api;

use App\Dependency;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class GeneralInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    //

    public function getGeneralInfo(){

        $users = User::all();
        $dependencies = Dependency::all();

        return response()->json([
            'users' => $users,
            'dependencies' => $dependencies
        ],200);
    }
}
