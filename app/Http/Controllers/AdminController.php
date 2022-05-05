<?php

namespace App\Http\Controllers;

use App\Models\{Admin, Message};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login-admin');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:16'
        ]);

        $admin = Admin::where('email', '=', $credentials['email'])->exists();

        if ($admin) {
            if (Auth::guard('admin')->attempt($credentials, $remember = true)) {
                $request->session()->regenerate();

                return redirect('admins');
            }
        }

        return back()->with('loginStatus', 'Login Failed! Please try again.');
    }

    public function logout()
    {
        Session::flush();

        Auth::guard('admin')->logout();

        return redirect('messages');
    }

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

    public function destroy(Request $request)
    {
        $buttonType = $request->button;

        $ids = explode(',', $request->id);

        if ($buttonType === "messages") {
            if (empty($request->id)) return back();

            $this->deleteImages($ids);
            Message::destroy($ids);
        } else {
            $this->deleteImages($ids);

            if ($buttonType === "message") {
                Message::destroy($request->id);
            }
        }

        return back();
    }

    private function deleteImages($ids)
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

    public function restore($id)
    {
        return Message::withTrashed()->find($id)->restore();
    }
}
