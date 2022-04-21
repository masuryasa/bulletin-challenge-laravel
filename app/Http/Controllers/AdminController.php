<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $messages = Message::withTrashed()->latest('id')->with('user')
            ->title()->body()->image()->status()
            ->paginate(20)->withQueryString();

        return view('admin.index', [
            'messages' => $messages,
            'page' => 'home'
        ]);
    }

    public function delete(Request $request)
    {
        if ($request->button === "messageAll") {
            if (empty($request->id)) return back();

            $ids = explode(',', $request->id);

            foreach ($ids as $id) {
                $message    = Message::find($id);

                $image_name = $message->image_name;

                if (isset($image_name)) {
                    Storage::delete("public/images/" . $image_name);

                    $message->image_name = null;
                }

                $message->save();

                $message->delete();
            }
        } else {
            $message    = Message::find($request->id);

            $image_name = $message->image_name;

            if (isset($image_name)) {
                Storage::delete("public/images/" . $image_name);

                $message->image_name = null;
            }

            $message->save();

            if ($request->button === "message") {
                $message->delete();
            }
        }

        return back();
    }

    public function recover(Request $request)
    {
        return Message::withTrashed()->where('id', $request->id)->restore();
    }
}
