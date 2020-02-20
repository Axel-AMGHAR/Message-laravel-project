<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        dd(Message::with('conversation')->get());
        return view('pages.chat', ['users' => User::get()]);
    }

    public function message_add(){


        return redirect()->back();
    }
}
