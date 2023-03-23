<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Employee;

class ApiTokenController extends Controller
{
    // {   
    //     "email" : "cosmin123@gmail.com",
    //     "password": "Cosmin123"
    // }
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:employees,email'],
            'password'      => ['required', 'string', 'min:8'],
        ]);
        if($validator->fails()){
            return response()->json(['message' => "Auth Failed"], 500);
        }else {
            $employee = new Employee([
                'name' => $request->name ?? "",
                'email' => $request->email,
                'phone' => $request->name ?? "",
                'password' => Hash::make($request->password)
            ]);
            $employee->save();
            $token = $employee->createToken('myapptoken')->plainTextToken;

            $response = [
                'employee' => $employee,
                'token'     => $token
            ];
            return response($response, 201);
        }
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'         => ['required', 'string', 'email', 'max:255'],
            'password'      => ['required', 'string', 'min:8'],
        ]);

        if($validator->fails()){
            return response()->json(['message' => "Auth Failed"], 500);
        }else {
            //Check email
            $employee = Employee::where('email', $request->email)->first();

            if(!$employee || !Hash::check($request->password, $employee->password)){
                return response([
                    'message' => 'Bad Creds'
                ],401);
            }

            $token = $employee->createToken('myapptoken')->plainTextToken;

            $response = [
                'employee' => $employee,
                'token'     => $token
            ];
            return response($response, 201);
        }
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
