<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users_index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required||string',
            'username' => ['required', Rule::unique('users')->ignore($user->id)]
        ]);

        // $user->update($request->all());
        $user->update($validated);

        return back();
    }

    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, Auth::user()->getAuthPassword()) == false) {
                        $fail('Current password does not match.');
                    }
                },
            ],  
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // $user->update(['password' => Hash::make($request->password)]);
        $user->update(['password' => Hash::make($validated['password'])]);

        return back();
    }

    public function updatePicture(Request $request, User $user){
        $path = Storage::disk('public')->putFile('user_images', $request->file('user_image'));
        
        $user->update(['user_image' => $path]);

        return back();
    }

    public function updateSignature(Request $request, User $user){
        $path = Storage::disk('public')->putFile('user_signatures', $request->file('user_image'));

        $user->update(['user_signature' => $path]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
