<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\API\LoginRequest;
use \Auth;

class AuthController extends Controller
{
    /**
     * Authenticate registered user.
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try{
            Auth::attempt($request->validated());
            return $this->authenticated(Auth::user());
		}
		catch(\Exception $e){
			return $this->error($e);
		}
    }

    public function logout(Request $request){
        try{
            Auth::user()->currentAccessToken()->delete();
            return response()->json([
                'success' => true,
            ]);
        }
        catch(\Exception $e){
            return $this->error($e);
        }
    }

    /**
     * Get authenticated response
     * @param array
     */
    private function authenticated(User $user)
    {
        return response()->json([
            'success' => true,
            'token' => $user->createToken('api')->plainTextToken,
            'user' => $user->toArray(),
        ]);
    }
}
