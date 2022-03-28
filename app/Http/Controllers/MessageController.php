<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'name' => 'required|min:3|max:16',
            'title' => 'required|min:10|max:32',
            'body' => 'required|min:10|max:200',
            'password' => 'nullable|numeric|digits:4',
            'image' => 'nullable|image|mimes:png,jpg,svg,jpeg,gif|max:2048',
        ]);

        $name = $request->input('name');
        $title = $request->input('title');
        $body = $request->input('body');
        $password = $request->input('password');
        $image = $request->file('image');
        $image_path = !is_null($image) ? $image->store('public/images') : null;
        $image_name = !is_null($image) ? $image->getClientOriginalName() : null;

        date_default_timezone_set("Asia/Singapore");
        $message = ['name' => $name, 'title' => $title, 'body' => $body, 'pass' => $password, 'image_path' => $image_path, 'image_name' => $image_name, 'date' => date("d-m-Y"), 'time' => date("H:i")];

        DB::table('messages')->insertGetId($message);

        // return back();
    }

    public function getDetail(Request $request)
    {
        $id = $request->input('id');
        $message = DB::table('messages')->find($id);

        return $message;
    }

    public function edit(Request $request)
    {
        $request->validate([
            'nameEdit' => 'required|min:3|max:16',
            'titleEdit' => 'required|min:10|max:32',
            'bodyEdit' => 'required|min:10|max:200',
            'passwordEdit' => 'nullable|numeric|digits:4',
            'imageEdit' => 'nullable|image|mimes:png,jpg,svg,jpeg,gif|max:2048',

        ]);

        $id = $request->input('idEdit');
        $name = $request->input('nameEdit');
        $title = $request->input('titleEdit');
        $body = $request->input('bodyEdit');
        $password = $request->input('passwordEdit');
        $image = $request->file('imageEdit');
        $image_path = !is_null($image) ? $image->store('public/images') : null;
        $image_name = !is_null($image) ? $image->getClientOriginalName() : null;

        date_default_timezone_set("Asia/Singapore");
        $message = ['name' => $name, 'title' => $title, 'body' => $body, 'pass' => $password, 'image_path' => $image_path, 'image_name' => $image_name, 'date' => date("d-m-Y"), 'time' => date("H:i")];

        DB::table('messages')
            ->where('id', $id)
            ->update($message);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        DB::table('messages')
            ->where('id', $id)
            ->delete();

        return back();
    }
}
