<?php

namespace App\Http\Controllers;

use App\Models\{District, Division, User};
use Illuminate\Http\Request;
use File;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }
    public function create()
    {
        $title = "Tambah Pengguna";

        return view('user.create',compact('divisions','title','districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'password' => 'required|min:8|confirmed'
        ],[
            'name.required' => 'Nama harus diisi !',
            'photo.mimes' => 'File yang diterima adalah png, jpg dan jpeg',
            'email.required' => 'Email harus diisi !',
            'email.email' => 'Email tidak valid !',
            'email.unique' => 'Email sudah dipakai !',
            'role.required' => 'Pilih peran pengguna !',
            'role.in' => 'Peran tidak valid !',
            'password.required' => 'Password harus diisi !',
            'password.min' => 'Password minimal 8 karakter !',
            'password.confirmed' => 'Konfirmasi password salah !'
        ]);

        $photo = null;
        if($request->photo){
            $photo = $request->photo->store(
                'user', 'public'
            );
            $photo = "/storage/$photo";
        }

        $user = new User;
        $user->name = $request->name;
        $user->photo = $photo;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/user')->with('success', 'Pengguna berhasil ditambahkan !');
    }
    
    public function show(User $user)
    {
        $html = view('user.show', compact('user'))->render();

        return response(['success' => true, 'html' => $html]);
    }
    
    public function edit(User $user)
    {
        $title = "Edit Pengguna";

        return view('user.edit', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:8|confirmed'
        ],[
            'name.required' => 'Nama harus diisi !',
            'photo.mimes' => 'File yang diterima adalah png, jpg dan jpeg',
            'email.required' => 'Email harus diisi !',
            'email.email' => 'Email tidak valid !',
            'email.unique' => 'Email sudah dipakai !',
            'role.required' => 'Pilih peran pengguna !',
            'role.in' => 'Peran tidak valid !',
            'password.min' => 'Password minimal 8 karakter !',
            'password.confirmed' => 'Konfirmasi password salah !'
        ]);

        if($request->photo){
            $photo = $request->photo->store(
                'user', 'public'
            );
            $photo = "/storage/$photo";

            $file_path = public_path($user->photo);

            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }

        $user->name = $request->name;
        if($request->photo){
            $user->photo = $photo;
        }
        $user->email = $request->email;
        $user->role = $request->role;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        
        return redirect('/user')->with('success', 'Data pengguna berhasil diubah !');
    }
    
    public function destroy(User $user)
    {
        // $file_path = public_path($user->photo);

        // if (File::exists($file_path)) {
        //     File::delete($file_path);
        // }
        // $user->delete();

        // $users = User::all();
        // $html = view('user.table', compact('users'))->render();

        // return response(['success' => true, 'html' => $html, 'message' => 'Data pengguna berhasil dihapus !']);
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8|confirmed'
        ],[
            'name.required' => 'Nama harus diisi !',
            'photo.mimes' => 'File yang diterima adalah png, jpg dan jpeg',
            'email.required' => 'Email harus diisi !',
            'email.email' => 'Email tidak valid !',
            'email.unique' => 'Email sudah dipakai !',
            'password.min' => 'Password minimal 8 karakter !',
            'password.confirmed' => 'Konfirmasi password salah !'
        ]);

        if($request->photo){
            $photo = $request->photo->store(
                'user', 'public'
            );
            $photo = "/storage/$photo";

            $file_path = public_path($user->photo);

            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }

        $user->name = $request->name;
        if($request->photo){
            $user->photo = $photo;
        }
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('/profile')->with('success', 'Profil berhasil diupdate !');
    }
}
