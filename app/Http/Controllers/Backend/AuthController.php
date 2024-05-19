<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash, Session, Validator, DB;

class AuthController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.auth.login');
    }

   

    /**
     * Login Post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role->id == 1) {
                return redirect()->route('admin.dahsboard.index')->withSuccess('Signed in');
            }elseif (Auth::user()->role->id == 2) {
                return redirect()->route('user.car.index');
            }
           
        }
 
        return redirect()->route("auth.signin")->with('authError',  'Email dan password salah!');
    }

     /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect()->route('auth.signin');
    }

     /**
     * Register.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('backend.auth.register');
    }
    
     /**
     * Register.
     *
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3|max:50',
                'email' => 'email|unique:users',
                'password' => 'required|min:6',
                'sim' => 'required|min:6',
                'phone' => 'required|min:6',
                'address' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::create([
                'role_id' => 2,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'sim' => $request->sim,
                'password' => bcrypt($request->password),
            ]);

        

            DB::commit();
            return redirect()->route('auth.signin')->with('status',  'Register berhasil.');

        } catch (Exception $e) {
            DB::rollback();
            return back()->with('status', 'Oops something went wrong :(');
        }
       
    }
}
