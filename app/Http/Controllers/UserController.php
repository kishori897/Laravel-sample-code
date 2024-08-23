<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\User;

use Illuminate\Http\Request;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{    
    /**
     * login
     *
     * @return View
     */
    public function login(): View
    {
        return view('users.login');
    }

    /**
     * login
     *
     * @return RedirectResponse
     */
    public function postlogin(Request $r ): RedirectResponse
    {
         $this->validate($r, [
            'email'     => 'required|email',
            'password'   => 'required'
        ]);

        if (Auth::attempt(['email'=>$r->email,'password'=>$r->password])) {
             return redirect()->route('users.index')->with(['success' => 'User loggedIn successfully.!']);
        }
        return redirect()->back()->with('error','Invalid Credentials.Please try again.');
        
    }

    public function logout(){
        
        Auth::logout();
        return redirect()->route('users.index')->with(['success' => 'User logged out successfully.!']);

    }
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get users
        $users = User::latest()->paginate(5);

        //render view with users
        return view('users.index', compact('users'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('users.create');
    }
 
    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:2|max:20',
            'email'     => 'required|email|unique:users,email',
            'password'   => 'required|min:8'
        ]);

        
        //create user
        User::create([
            'name'     => $request->name,
            'email'     => $request->email,
            'password'   => Hash::make($request->password)
        ]);

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'User Created successfully.!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get user by ID
        $user = User::findOrFail($id);

        //render view with user
        return view('users.show', compact('user'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(string $id): View
    {
        //get use by ID
        $user = User::findOrFail($id);

        //render view with user
        return view('users.edit', compact('user'));
    }
        
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:2|max:20',
            'email'     => 'required|email|unique:users,email,'.$id,
            
        ]);

        //get user by ID
        $user = User::findOrFail($id);

        

        //update user 
        $user->update([
            'name'     => $request->name,
            'email'   => $request->email
        ]);
        

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'User Data updated successfully!']);
    }

    /**
     * destroy
     *
     * @param  mixed $user
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get user by ID
        $user = User::findOrFail($id);

        
        //delete user
        $user->delete();

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'User deleted successfully!']);
    }

    /**
     * change password
     *
     * @param  mixed $id
     * @return void
     */
    public function changePassword(string $id): View
    {
        
        return view('users.change_password', compact('id'));
    }

    
    public function updatePassword(string $id,Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'old_password'     => 'required|min:8',
            'new_password'     => 'required|min:8',
            'confirm_password'  => 'required|min:8|same:new_password',
            
        ]);

        $user=User::find($id);

        if (!$user) {
            return back()->with(['error' => 'User not foubd!']);
        }

        // Check if the provided current password matches the user's password
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with("error", 'Old Password does not match');
        }
        $user->password=Hash::make($request->new_password);
        if($user->save()) {
             //redirect to index
            return redirect()->route('users.index')->with(['success' => 'Password updated successfully!']);
        }


              
        
    }
}