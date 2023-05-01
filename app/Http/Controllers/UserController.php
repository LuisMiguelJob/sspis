<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $rules;
    private $rulesPassword;
    public function __construct()
    {
        $this->middleware('can:users.index');
        
        $this->rules = [
            'name' => ['required', 'string', 'min:5', 'max:255'],
        ];

        $this->rulesPassword = [
            'password' => ['required', 'string', 'min:1', 'max:255'],
            'password_confirmation' => ['required', 'same:password'], 
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // temporal, luego poner con auth
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate($this->rules + ['email' => [
            'required',
            'string',
            Rule::unique('users')->ignore($user->id),
            ],
        ]);

        User::where('id', $user->id)->update($request->except('_token', '_method'));
        return redirect()->route('users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updatePassword(Request $request, User $user){ 
        $request->validate($this->rulesPassword);

        // Arreglar esto para que guarde contraseñas
        /* $request['password'] = Hash::make($request->input('password')); */

        if (Hash::check($request->current_password, $user->password)) {
            /* User::where('id', $user->id)->update($request->except('_token', '_method', 'current_password', 'password_confirmation')); */
            return "chequeo";
            /* return redirect()->route('users.edit', $user); */       
        }
    }
}
