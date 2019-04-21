<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /** admin/123
     *
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['name' => $request->post('login'), 'password' => $request->post('password')], true)) {

            $user = Auth::user();
            $token = $user->generateToken();

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        if(User::removeToken($request->header('x-access-token')))
        {
            return response()->json(['status' => 0], 200);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function me(Request $request)
    {
        $user = User::getUserByToken($request->header('x-access-token'));

        if($user)
        {
            return response()->json($user, 200);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    public function other()
    {
        return response()->json(null, 200);
    }
}
