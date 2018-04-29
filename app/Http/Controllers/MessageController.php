<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;

class MessageController extends Controller
{
    //

    public $user;

    public function __construct(){
        $this->middleware('auth');
    }

    public function show(Request $request,User $user){
        return view('messages')->with(['to'=>$request->user]);
    }

    public function store(Request $request,User $user){

    }


}
