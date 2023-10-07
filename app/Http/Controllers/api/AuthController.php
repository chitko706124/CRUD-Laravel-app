<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Rules\CheckPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $verify_code = rand(100, 999);
        logger("verify code of " . $request->email . " is " . $verify_code);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->verify_code = $verify_code;
        $student->user_token = bcrypt($verify_code);
        $student->api_token = bcrypt(rand(1000, 9999));
        $student->password = Hash::make($request->password);
        $student->save();

        return response()->json(["message" => "Register successful"]);
    }


    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:students,email',
                'password' => ["required", "min:8", new CheckPassword],
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
            'user_token' => $student->user_token,
            'api_token' => $student->api_token,
            'email_verified_at' => $student->email_verified_at,
            'created_at' => $student->created_at,
            'updated_at' => $student->updated_at
        ];

        session(['auth' => $arr]);

        // return response()->json([
        //     "message" => "login successful",
        //     "info" => $student,
        //     "api_token" => $student->api_token
        // ]);

        return response()->json($arr);
    }
}
