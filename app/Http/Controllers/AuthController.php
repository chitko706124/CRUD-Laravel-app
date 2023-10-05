<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Object_;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $verify_code = rand(100, 999);
        logger("Your verify code is " . $verify_code);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->verify_code = $verify_code;
        $student->password = Hash::make($request->password);
        $student->save();

        return redirect()
            ->route('auth.login')
            ->with('message', 'Register Successful');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function check(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:students,email',
                'password' => 'min:8',
            ],
            [
                'email.exists' => 'email or password wrong',
            ],
        );

        $student = Student::where('email', $request->email)->first();

        $arr = (object)[
            'id' => $student->id,
            'name' => $student->name,
            'email' => $student->email,
            'password' => $student->password,
            'verify_code' => $student->verify_code,
            'email_verified_at' => $student->email_verified_at,
            'created_at' => $student->created_at,
            'updated_at' => $student->updated_at
        ];

        if (!Hash::check($request->password, $student->password)) {
            return redirect()
                ->back()
                ->withErrors(['email' => 'email or password wrong']);
        }

        session(['auth' => $arr]);

        return redirect()->route('dashboard.home');
    }

    public function logout()
    {
        session()->forget('auth');
        return redirect()->route('auth.login');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function changePasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->current_password, session("auth")->password)) {
            return redirect()
                ->back()
                ->withErrors(['current_password' => 'Password does not match']);
        }

        $student = Student::find(session("auth")->id);
        $student->password = Hash::make($request->password);
        $student->update();

        session()->forget('auth');
        return redirect()->route('auth.login');
    }

    public function verify()
    {
        return view("auth.mail-verify");
    }

    public function verifyStore(Request $request)
    {
        $request->validate([
            "verify_code" => "required|numeric"
        ]);


        if ($request->verify_code != session("auth")->verify_code) {
            return redirect()->back()->withErrors(["verify_code" => "Something was wrong"]);
        };

        $student = Student::find(session("auth")->id);
        $student->email_verified_at = now();
        $student->update();

        $authData = session("auth");
        // Update the email_verified_at attribute
        $authData->email_verified_at = now();
        // Store the updated session data back in the session
        session(['auth' => $authData]);


        return redirect()->route("dashboard.home");
    }
}
