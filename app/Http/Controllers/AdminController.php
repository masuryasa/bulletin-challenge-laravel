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

        return view('admin.index', ['messages' => $messages]);
    }

    public function delete(Request $request)
    {
        if ($request->button == "messageAll") {
            $ids = explode(',', $request->id);

            foreach ($ids as $id) {
                $message = Message::find($id);

                $image_path = $message->image_path;

                if (!is_null($image_path)) {
                    Storage::delete($image_path);

                    $message->image_name = null;
                    $message->image_path = null;
                }

                $message->save();

                $message->delete();
            }
        } else {
            $message = Message::find($request->id);

            $image_path = $message->image_path;

            if (!is_null($image_path)) {
                Storage::delete($image_path);

                $message->image_name = null;
                $message->image_path = null;
            }

            $message->save();

            if ($request->button == "message") {
                $message->delete();
            }
        }

        return back();
    }

    public function recover(Request $request)
    {
        $recover = Message::withTrashed()->where('id', $request->id)->restore();

        return $recover;
    }
}
