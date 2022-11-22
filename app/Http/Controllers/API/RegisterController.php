<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'job' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            // 'c_password' => 'required|uni',
        ]);

        if($validator->fails()){
            // return $this->sendError('Validation Error.', $validator->errors());
            return response()->json($validator->errors(),status:400);
        }

        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        $user = User::create([
            'name'  => $request->name,
            'job'  => $request->job,
            'email'  => $request->email,
            'password'  => bcrypt($request->password),
        ]);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        // return $this->sendResponse($success, 'User register successfully.');
        return response()->json($success);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
            ])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return response()->json($success);
            // return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return response()->json(status: 401);

            // return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
