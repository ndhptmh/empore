<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\{Book,BookLoan,User,Member,Admin};
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    
    public function logout()
    {
        //dd(Auth::guard('admin')->check());
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
        else if(Auth::guard('member')->check()){
            Auth::guard('member')->logout();
        }
    	return redirect('/');
    }

    public function login()
    {
        if(auth()->user()){
            return redirect('/');
        }

    	return view('auth.login');
    }

    public function auth(Request $request)
    {
        
    	$loginData = $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ],
        [
            'email.required' => 'Masukan email terlebih dahulu',
            'password.required' => 'Masukan password terlebih dahulu',
            'password.min' => 'Password minimal 8 karakter',
        ]);
        $cek = Admin::where('email', '=', $request->email)->first();
        $member = Member::where('email', '=', $request->email)->first();
        //dd($member);
        if($cek){
            if (!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return back()->withErrors(['Email atau password yang anda masukan salah!']);
            }
            return redirect('/dashboard')->with('success', 'Login sebagai admin!');
        }
        elseif(!$cek && $member){
            if (!Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return back()->withErrors(['Email atau password yang anda masukan salah!']);
            }
            return redirect('/user/buku')->with('success', 'Login sebagai anggota!');
        }
        return back()->withErrors(['Email atau password yang anda masukan salah!']);
    }

    public function dashboard()
    {
        $user = Member::count();
        $book = Book::count();
        $pinjam = BookLoan::count();
        return view('admin/dashboard', compact('book', 'pinjam', 'user'));
    }
}
