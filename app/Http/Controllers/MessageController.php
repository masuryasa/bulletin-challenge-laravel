<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = DB::table('messages')
            ->orderByDesc('id')
            ->get();

        return view('index', ['messages' => $messages]);
    }

    public function insert(Request $request)
    {
        $validate = $request->validate(['image' => 'required|image|mimes:jpg,png,svg,jpeg,gif|max:2048']);

        $name = $request->input('name');
        $title = $request->input('title');
        $body = $request->input('body');
        $password = $request->input('password');
        $image_path = $request->file('image')->store('public/images');
        $image_name = $request->file('image')->getClientOriginalName();

        date_default_timezone_set("Asia/Singapore");
        $message = ['name' => $name, 'title' => $title, 'body' => $body, 'pass' => $password, 'image_path' => $image_path, 'image_name' => $image_name, 'date' => date("d-m-Y"), 'time' => date("H:i")];

        DB::table('messages')->insertGetId($message);

        return redirect('');
    }
}
