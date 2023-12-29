<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


class AuthController extends Controller
{
    use ApiResponse;
    function login(Request $request)
    {
        $validate = $this->rules($request);
        if($validate->fails()) {
            return $this->failed_response(data: $validate->errors());
        }

        $user = User::whereEmail($request->email)->first();
        if(is_null($user)) {
            return $this->failed_response(
                data: [
                "data"=>' هذا المستخدم غير موجود'
            ], message:' not found');
        }
        
        if (!Hash::check($request->password, $user->password)) {
            return $this->failed_response(data: [
                "error"=>'البيانات المرسلة خاطئة'
            ], message:'invalid_credentials');
        }

        $user->token = $user->createToken('api_token')->plainTextToken;
        return $this->success_response(data: $user);
    }

    function signup(Request $request)
    {
        $validate = $this->rules($request);
        if ($validate->fails()) {
            return $this->failed_response(data: $validate->errors());
        }
        
        $user = User::create($request->all()); 
        // $user->assignRole('NormalUser');
        return $this->success_response(data: $user);
    }

    function logout()
    {
        

        // Auth::user()->currentAccessToken()->delete();
        if (Auth::check()) {
            $token = Auth::user()->token();
            $token->revoke();
            return $this->sendResponse(null, 'User is logout');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'] );
        } 
    }

    function rules(Request $request)
    {
       
        $signIn = Route::currentRouteName() == 'login';
        return Validator::make(
            $request->all(),
            [
                'name' => $signIn ? '' : ['required','regex:/^[ء-ي ]+$/u'],
                'address'=> $signIn ?'': ['required','regex:/^[ء-ي ]+$/u'],
                'email' => ['required', $signIn ? '' : 'unique:users,email'],
                'contact_number' => $signIn ? '' : 'required|unique:users,contact_number|numeric|digits:9',
                'password' => ['required', $signIn ? null : 'confirmed', 'min:8']
            ]

        );
    }
}
