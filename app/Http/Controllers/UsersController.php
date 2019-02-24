<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('administer');

        $users = User::orderByRaw("CASE user_type_id 
                                    WHEN user_type_id = '4' THEN 1 
                                    WHEN user_type_id = '5' THEN 2 
                                    WHEN user_type_id = '2' THEN 3 
                                    WHEN user_type_id = '3' THEN 4 
                                    WHEN user_type_id = '1' THEN 5 
                                    END ASC")->get();

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
        $this->authorize('administer');

        return $user->toJson();
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
            'name' => 'required|string',
            'username' => ['required', Rule::unique('users')->ignore($user->id)]
        ]);

        // $user->update($request->all());
        $user->update($validated);

        return back();
    }

    public function updateByAdmin(Request $request, User $user)
    {
        $this->authorize('administer');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'position' => 'required'
        ]);

        if($validator->fails()){
            return back()
                    ->withErrors($validator, 'edit')
                    ->withInput()
                    ->with('id', $user->id);
        }

        $user->update($validator->valid());

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
        $this->authorize('administer');

        $user->userable->delete();

        $user->delete();

        return back();
    }
}
