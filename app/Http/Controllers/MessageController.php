<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest('id')->with('user')->paginate(2);

        return view('index', ['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|min:3|max:16',
            'title' => 'required|min:10|max:32',
            'body' => 'required|min:10|max:200',
            'password' => 'nullable|numeric|digits:4',
            'image' => 'nullable|image|mimes:png,jpg,svg,jpeg,gif|max:1024',
        ]);

        $message = new Message;

        $message->name = $request->name;
        $message->title = $request->title;
        $message->body = $request->body;
        $message->password = is_null($request->password) ? null : Hash::make($request->password);
        $image = $request->file('image');
        $message->image_path = !is_null($image) ? $image->store('public/images') : null;
        $message->image_name = !is_null($image) ? $image->getClientOriginalName() : null;
        $message->user_id = $request->user_id;

        $message->save();

        return back();
    }

    public function passwordValidation(Request $request)
    {
        $id = (int)$request->id;
        $password = $request->password;

        if (is_null($password)) return null;
        else (int)$password;

        $hashedPassword = Message::where('id', $id)->first()->password;

        return Hash::check($password, $hashedPassword);
    }

    public function getDetail(Request $request)
    {
        $message = Message::all();

        return $message->find($request->id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nameEdit' => 'required|min:3|max:16',
            'titleEdit' => 'required|min:10|max:32',
            'bodyEdit' => 'required|min:10|max:200',
            'passwordEdit' => 'nullable|numeric|digits:4',
            'imageEdit' => 'nullable|image|mimes:png,jpg,svg,jpeg,gif|max:2048',
        ]);

        $messageUpdate = Message::find($request->idEdit);

        $messageUpdate->name = $request->nameEdit;
        $messageUpdate->title = $request->titleEdit;
        $messageUpdate->body = $request->bodyEdit;
        $password = $request->passwordEdit;
        !empty($password) ? $messageUpdate->password = Hash::make($password) : null;
        $deleteImageCheck = $request->deleteImage;

        if (!is_null($deleteImageCheck)) {
            $messageUpdate->image_path = null;
            $messageUpdate->image_name = null;

            Storage::delete($request->oldImagePath);

            $update = $messageUpdate->save();

            return $update;
        }

        $image = $request->file('imageEdit');
        !is_null($image) ? (!is_null($request->oldImagePath) ? Storage::delete($request->oldImagePath) : null) : null;
        !is_null($image) ? $messageUpdate->image_path = $image->store('public/images') : null;
        !is_null($image) ? $messageUpdate->image_name = $image->getClientOriginalName() : null;

        $update = $messageUpdate->save();

        return $update;
    }

    public function delete(Request $request)
    {
        Message::find($request->id)->delete();
        Storage::delete($request->image);

        return back();
    }
}
