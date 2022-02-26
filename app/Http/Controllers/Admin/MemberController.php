<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Member::get();
        return view('admin/member/index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/member/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ],[
            'name.required' => 'Nama tidak boleh kosong !',
            'username.required' => 'Username tidak boleh kosong !',
            'username.required' => 'Username sudah terdaftar !',
            'email.required' => 'Email tidak boleh kosong !',
            'email.email' => 'Email tidak valid !',
            'email.unique' => 'Email sudah terdaftar !',
            'password.required' => 'Password tidak boleh kosong !',
            'password.min' => 'Password minimal 8 karakter !',
            'password.confirmed' => 'Konfirmasi password tidak cocok !',
        ]);

        $member = Member::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt(trim($request->password)),
        ]);

        return redirect('/member')->with('success', 'Berhasil mendaftarkan member baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('admin/member/detail', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin/member/edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$member->id,
            'email' => 'required|email|unique:users,email,'.$member->id,
        ],[
            'name.required' => 'Nama tidak boleh kosong !',
            'username.required' => 'Username tidak boleh kosong !',
            'username.required' => 'Username sudah terdaftar !',
            'email.required' => 'Email tidak boleh kosong !',
            'email.email' => 'Email tidak valid !',
            'email.unique' => 'Email sudah terdaftar !',
        ]);

        if($request->password!=null){
            $request->validate([
                'password' => 'min:8|confirmed'
            ],[
                'password.min' => 'Password minimal 8 karakter !',
                'password.confirmed' => 'Konfirmasi password tidak cocok !',
            ]);
        }

        Member::whereId($member->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt(trim($request->password)),
        ]);

        return redirect('/member')->with('success', 'Berhasil update data member!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();       
        return true;
    }
}
