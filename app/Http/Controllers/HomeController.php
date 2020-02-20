<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['users' => User::where('id','!=', Auth::id())->get()]);
    }

    public function chat($user_id)
    {
        $conv = Conversation::where([
                ['user1_id', '=', $user_id],
                ['user2_id', '=',  Auth::id()]
            ])->orWhere([
                ['user1_id', '=',Auth::id() ],
                ['user2_id', '=', $user_id ]
            ])->with('messages')->first();

        $messages = Array();
        if($conv){
            foreach($conv->messages as $message){
                array_push($messages, [
                    User::select('name')->where('id',$message->user_id)->first()->name,
                    $message->message,
                    $message->created_at->toDateTimeString()
                ]);
            }
            return view('pages.chat', [
                'messages' => $messages,
                'user' => User::where('id',$user_id)->first(),
                'conversation_id' => $conv->id
            ]);
        }else{
            return view('pages.chat', [
                'user' => User::where('id',$user_id)->first(),
            ]);
        }
    }

    public function chat_add(Request $request){
        if(!isset($request->conversation_id)){
            $conversation = new Conversation;
            $conversation->user1_id = Auth::id();
            $conversation->user2_id = json_decode($request->user)->id;
            $conversation->save();
            $request->conversation_id = $conversation->id;
        }

        $this->validate($request,[
            'message' => ['string','required'],
        ]);

        $message = new Message;
        $message->conversation_id = $request->conversation_id;
        $message->user_id = Auth::id();
        $message->message = $request->message;
        $message->save();

        return back();
    }
}
