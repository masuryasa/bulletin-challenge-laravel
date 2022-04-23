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
        $ids = explode(',', $request->id);

        if ($request->button === "messages") {
            if (empty($request->id)) return back();

            $this->deleteImages($ids);
            Message::destroy($ids);
        } else {
            $this->deleteImages($ids);

            if ($request->button === "message") {
                Message::destroy($request->id);
            }
        }

        return back();
    }

    public function deleteImages($ids)
    {
        foreach ($ids as $id) {
            $message    = Message::find($id);
            $image_name = $message->image_name;

            if (!is_null($image_name)) {
                Storage::delete("public/images/" . $image_name);

                $message->image_name = null;
            }

            $message->save();
        }
    }

    public function recover(Request $request)
    {
        return Message::withTrashed()->find($request->id)->restore();
    }
}
