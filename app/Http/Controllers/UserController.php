<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);

    }

    public function updateU(Request $request, User $user)
    {
        $this->authorize('update', $user);

            $validatedData = $request->validate([
                'name' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users',
                'password' => 'string|min:6',
                ]);

            $user->update($validatedData);
            return response()->json($user, 200);
    }

    public function deleteU(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return response()->json(null, 204);
    }

    public function showU()
    {
        $this->authorize('viewAny', User::class);
        return response()->json(User::all());

    }

    public function showId(User $user)
    {
        $this->authorize('view', $user);
        return $user;
    }

    public function getAuthenticatedUser(User $user)
    {

        $this->authorize('view', $user);

        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
            return response()->json(compact('user'));
    }

    public function logout(){

        $forever = true;
        JWTAuth::getToken();
        JWTAuth::invalidate($forever);

    }

}
