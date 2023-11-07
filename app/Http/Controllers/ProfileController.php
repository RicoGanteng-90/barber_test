<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('session.profile');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(!Hash::check($request->oldPassword, auth()->user()->password)){
            return back()->with('error', 'Password tidak ada dalam database');
        }

        if($request->newPassword != $request->repeatPassword){
            return back()->with('error', 'Password saat ini dan password baru tidak sama');
        }

        auth()->user()->update([
            'password' => Hash::make($request->newPassword)
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'nama' => 'nullable|string',
        'email' => 'nullable|email|unique:users,email,'.Auth::id(),
        'no_telp' => 'nullable|string',
    ]);

    try {
        $user->nama_user = $request->input('nama');
        $user->email = $request->input('email');
        $user->no_telp = $request->input('not_telp');
        $user->save();

        return back()->with('success2', 'User berhasil diupdate');
    } catch (\Exception $e) {
        return back()->with('error2', 'Gagal mengupdate user');
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
