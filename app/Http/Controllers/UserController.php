<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $body = json_decode($request->getContent());

        $username = $body->username;
        $password = $body->password;

        $credentials = ['username' => $username, 'password' => $password];

        // var_dump($credentials);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function all()
    {
        return User::all();
    }

    public function save_batch(Request $request)
    {
        $users_json = (array) json_decode($request->getContent());

        $users = [];

        foreach ($users_json as $user_json) {
            $new_user = json_decode(json_encode(new \App\Models\User((array) $user_json)));

            // var_dump($new_user);

            array_push($users, $new_user);
            User::updateOrCreate(['id' => $new_user->id], (array) $new_user);
        }

        return $users;
    }

    public function populate()
    {
        $foundAdmin = User::where('name', '=', 'admin')->first();


        if ($foundAdmin == null) {
            $user = new User;
            $user->name = 'Administrator';
            $user->username = 'admin';
            $user->password = Hash::make(env('ADMIN_PASSWORD', '12345678'));

            var_dump($user->password);

            $savedUser = User::updateOrCreate(['id' => $user->id], (array) json_decode(json_encode($user)));
            var_dump(json_encode($savedUser));
        }

        // var_dump($foundAdmin);

        // return 
    }
}
