<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{   
  
    public function login()
    {
        return view('pages/users/login');
    }

  
    public function register()
    {
        return view('pages/users/register');
    }

  
    public function index() {
        $users = User::latest()->filter(request(['search', 'role']))->paginate(6);
        return view('pages/users/users', compact('users'));
    }


    public function show(User $user) {
       
        if (Auth::user()->role !== 'admin' && Auth::id() !== $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot view a user that is not yours!');
        }
      
        return view('pages/users/profile', compact('user'));
    }

 
    public function edit(User $user) {
      
        if (Auth::user()->role !== 'admin' && Auth::id() !== $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot view a user that is not yours!');
        }
        return view('pages/users/update-profile', compact('user'));
    }

    public function update(Request $request, User $user) {
        
        if (Auth::user()->role !== 'admin' && Auth::id() !== $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot update a user that is not yours!');
        }

        $userFields = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin', 'tutor', 'student'])],
        ]);


        $user->update($userFields);
        return redirect("/users/{$user->id}")->with('success', 'User updated successfully');
    }


    public function authenticate(Request $request) {

        $formFields = $request->validate([
            "email"=> ["required","email"],
            "password"=> "required",
        ]);
        
 
        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();

            return redirect("/dashboard")->with("message","You are now logged in");
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput();
    }

  
    public function store(Request $request) {
  
        $formFields = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);


        $formFields["password"] = bcrypt($formFields["password"]);

        $user = User::create($formFields);
        Auth::login($user);

        return redirect("/dashboard")->with('success',"You are now registered and logged in");
    }
    

    public function logout(Request $request) {

 
        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out');
    }

    
}
