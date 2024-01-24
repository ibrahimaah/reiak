<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('platform.auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try 
        // {
            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:users',
                // 'birth'=>'required',
                // 'number'=>'required',
                // 'gender'=>'required|in:man,female',
                'password'=>'required|confirmed|min:8|max:20',
            ]);
            $user = User::create([
                'name'=>$request->name,
                // 'number'=>$request->number,
                'role'=>'user',
                'email'=>$request->email,
                // 'birth'=>$request->birth,
                // 'gender'=>$request->gender,
                'password'=>Hash::make($request->password),
            ]);
            auth()->login($user);
            return redirect()->route('platform.index');
        // }
        // catch(Exception $ex)
        // {
            // dd($ex->getMessage());
        // }
        // return redirect()->route('login.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
