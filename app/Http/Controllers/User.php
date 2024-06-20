<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    public function index()
    {
        $users = UserModel::orderBy('first_name', 'asc');

        if(request()->has('search')){
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $users = $users->where(function($query) use($searchTerm) {
                    $query->where('users.first_name', 'like', "%$searchTerm%")
                        ->orWhere('users.middle_name', 'like', "%$searchTerm%")
                        ->orWhere('users.last_name', 'like', "%$searchTerm%")
                        ->orWhere('users.position', 'like', "%$searchTerm%");
                });
            }
        }
        $users = $users->paginate(10)
            ->appends(['search' => request()->get('search')]);
            
        return view('user.index', compact('users'));
    }

    public function show($id)
    {
        $userView = UserModel::find($id);
        return view('user.index', compact('userView'));
    }
    
    public function create() 
    {
        return view('user.create');
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'position' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ]);

        $validated['password'] = bcrypt($validated['password']);
        UserModel::create($validated);
        Session::flash('success', 'User Added Successfully!');
        return redirect('/users');//->with('status', 'User Added Successfully!');
    }

    public function edit($id)
    {
        $user = UserModel::find($id);
        $users = UserModel::all();
        return view('user.edit', compact('user', 'users'));
    }

    public function update(Request $request, UserModel $user)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'position' => ['required'],
            'username' => ['required'],
            'current_password' => ['nullable'],
            'new_password' => ['nullable', 'confirmed'],
            'new_password_confirmation' => ['nullable'],
        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }
            $user->password = bcrypt($validated['new_password']);
        }
    
        $user->update($request->except(['current_password', 'new_password', 'new_password_confirmation']));
        $user->update($validated);

        return redirect('/users')->with('success', 'User Successfully Updated!');
    }

    public function delete($id)
    {
        $user = UserModel::find($id);
        return view('user.delete', compact('user'));
    }

    public function destroy(Request $request, UserModel $user)
    {
        $user->delete($request);
        return redirect('/users')->with('success', 'User Successfully Deleted!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['username' => $validated['username'], 'password' => $validated['password']])) {
            $request->session()->regenerate();
            Session::flash('success', 'You have been logged in successfully!');
            return redirect('/dashboard');
        } else {
            session()->flash('error', 'Invalid username or password.');
        }

        return redirect('/');

        // $user = UserModel::where('username', $validated['username'])
        //     ->first();

        // if($user && auth()->attempt($validated)) {
        //     $request->session()->regenerate();
        //     Session::flash('success', 'You have been logged in successfully!');
        //     return redirect('/dashboard');
        // } else {
        //     session()->flash('error', 'Invalid username or password.');
        // }

        //return redirect('/');

    }

    public function processLogout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        Session::flash('logout', 'You are logged out!');
        return redirect('/');
    }

    public function anotherProcessLogout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('message_success', 'You are logged out!');
    }
}
