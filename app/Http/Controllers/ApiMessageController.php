<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\NewMessage;

class ApiMessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }


    public function get(Request $request){
        
        $all = Message::where('user_id',\Auth::id())
        ->where('to',$request->to)
        ->orwhere('user_id',$request->to)
        ->where('to', $request->from)
        ->get();
        

        return response()->json($all);
    }

    public function store(Request $request){
        

        $msg = new Message; 
       
        $msg->user_id = $request->from;
        $msg->to = $request->to;
        $msg->body = $request->body;
        $msg->save();
        
        broadcast(new NewMessage($msg))->toOthers();

        return response()->json($msg);
    }




}
