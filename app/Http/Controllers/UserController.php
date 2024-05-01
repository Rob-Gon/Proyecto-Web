<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Check availability of email [Front-end validation].
     */
    public function checkEmailAvailability(Request $request)
    {
        $user = DB::selectOne('SELECT * FROM users WHERE email = ?', [$request->email]);
        return response()->json(['available' => $user ? false : true]);
    }

    /**
     * Register an user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'user' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|min:6|max:255',
            'is_premium' => 'required|boolean', 
        ]);
    
        DB::insert('INSERT INTO users (user, email, password, is_premium) VALUES (?, ?, ?, ?)', [
            $request->user,
            $request->email,
            Hash::make($request->password),
            $request->is_premium,
        ]);
    
        return response()->json(['register' => true]);
    }

    /**
     * Login an user.
     */
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|max:255|email',
                'password' => 'required|min:6|max:255',
            ]);

        $user = DB::selectOne('SELECT * FROM users WHERE email = ?', [$request->email]);

        if (!$user) {
            return response()->json(['login' => false]);
        } else if (!Hash::check($request->password, $user->password)) {
            return response()->json(['login' => false]);
        } else {
            session(['user_id' => $user->id]);
            session(['user_name' => $user->user]);
            session(['user_isPremium' => $user->is_premium]);
            
            DB::update('UPDATE users SET token = ? WHERE id = ?', [Str::random(60), $user->id]);
            
            return response()->json(['login' => true]);
        }
    }

    /**
     * Logout an user.
     */
    public function logout()
    {
        DB::update('UPDATE users SET token = NULL WHERE id = ?', [session('user_id')]);
        session()->flush();
        return response()->json(['logout' => true]);
    }

    /**
     * Display a listing of the resource [API].
     */
    public function index()
    {
        $users = User::paginate(20);

        return new UserCollection($users);
    }

    /**
     * Display the specified resource [API].
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage [API].
     */
    public function store(StoreUserRequest $request) 
    {
        $request->merge(['password' => Hash::make($request->password)]);
        return new UserResource(User::create($request->all()));
    }

    /**
     * Update the specified resource in storage [API].
     */
    public function update(UpdateUserRequest $request, User $user) 
    {
        if($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
        }
        $user->update($request->all());
    }
}
