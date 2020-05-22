<?php

namespace App\Http\Controllers\api;

use App\Dependency;
use App\Document;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $documents = Document::all();
        $sinresolver = Document::where('status','1')->where('dependency_id',Auth::user()->dependency_id)->get();
        return response()->json([
            'users' => $users,
            'dependencies' => $dependencies,
            'documents' => $documents,
            'waiting' => $sinresolver
        ],200);
    }
}
