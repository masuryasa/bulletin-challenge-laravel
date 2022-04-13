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
        $messages = Message::latest('id')->with('user')->paginate(20);

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
        $message->body = nl2br($request->body);
        $message->password = is_null($request->password) ? null : Hash::make($request->password);
        $image = $request->file('image');
        $imageName = isset($image) ? $request->title . '+' . $image->getClientOriginalName() : null;
        isset($image) ? $image->storeAs('public/images', $imageName) : null;
        $message->image_name = isset($image) ? $imageName : null;
        $message->user_id = $request->user_id;

        $message->save();

        return back();
    }

    public function passwordValidation(Request $request, $src = null)
    {
        if ($src == "update") {
            $id = (int)$request->idEdit;
            $password = $request->passwordEdit;
        } elseif ($src == "delete") {
            $id = (int)$request->idDelete;
            $password = $request->passwordDelete;
        } else {
            $id = (int)$request->id;
            $password = $request->password;
        }

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
        $isMember = filter_var($request->isMember, FILTER_VALIDATE_BOOL);

        if ($this->passwordValidation($request, 'update') || $isMember) {
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

            if (isset($deleteImageCheck)) {
                $messageUpdate->image_name = null;

                Storage::delete($request->oldImagePath);

                $update = $messageUpdate->save();

                return $update;
            }

            $image = $request->file('imageEdit');
            isset($image) ? (isset($request->oldImagePath) ? Storage::delete($request->oldImagePath) : null) : null;

            $imageName = isset($image) ? $messageUpdate->title . '+' . $image->getClientOriginalName() : null;
            isset($image) ? $image->storeAs('public/images', $imageName) : null;
            $messageUpdate->image_name = isset($image) ? $imageName : null;

            $update = $messageUpdate->save();

            return $update;
        } else {
            return false;
        }
    }

    public function delete(Request $request)
    {
        $isMember = filter_var($request->isMember, FILTER_VALIDATE_BOOL);

        if ($this->passwordValidation($request, 'delete') || $isMember) {
            Message::find($request->idDelete)->forceDelete();
            Storage::delete($request->image);

            return back();
        } else {
            return false;
        }
    }
}
