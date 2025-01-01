<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function allUsers()
    {
        $users = User::all(); // Fetch all users
      
        return view('users.alluser', compact('users'));

    }

    public function adduser(Request $request)
    {
      
        return view('users.adduser');
    }
    
    
    public function store(Request $request)
    {
      
        $request->validate([
            'first_name' => 'required|string|max:255',
            'credit_limit' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'password' => 'required|string|min:6|same:password1',
        ]);
   
       
        // Store in the database
        User::create([
            'name' => $request->first_name,
            'phone' => $request->phone,
            'address' => "address",
            'credit_limit' => $request->credit_limit,
            'role' => $request->role,
            'email' => $request->email,
            'address' => $request->city,
            'password' => Hash::make($request->password),


        ]);
      
        return redirect()->route('alluser')->with('success', 'Shop created successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.useredit', compact('user'));
    }

}
