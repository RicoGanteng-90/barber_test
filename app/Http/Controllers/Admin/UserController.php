<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return view('admin.user.user', compact('user'));
    }

    public function user2()
    {
        $users = User::onlyTrashed()->get();

        return view('admin.user.restoreuser', compact('users'));
    }

    public function kembalikan($id)
    {
    	$user = User::onlyTrashed()->where('id', $id);
    	$user->restore();
    	return back();
    }

    public function kembalikan2()
    {
    	$user = User::onlyTrashed();
    	$user->restore();
    	return back();
    }

    public function hapus_permanen($id)
    {
    	$user = User::onlyTrashed()->where('id', $id);
    	$user->forceDelete();

    	return back();
    }

    public function hapus_permanen2()
    {
    	$user = User::onlyTrashed();
    	$user->forceDelete();

    	return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::all();

        if($user){
            $user = new User();
            $user->username = $request->input('username');
            $user->nama_user = $request->input('nama_user');
            $user->email = $request->input('email');
            $user->role_user = $request->input('role_user');
            $user->no_telp = $request->input('no_telp');
            $user->alamat = $request->input('alamat');
            $user->password = Hash::make($request->input('password'));

            $user->save();
        }
        return back()->with('success', 'User berhasil ditambahkan');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

    if ($user) {
        $user->username = $request->input('username');
            $user->nama_user = $request->input('nama_user');
            $user->email = $request->input('email');
            $user->role_user = $request->input('role_user');
            $user->no_telp = $request->input('no_telp');
            $user->alamat = $request->input('alamat');
            $user->role_user = $request->input('role');

        $user->save();

        return back()->with('success', 'user berhasil diupdate');
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
        $user = User::findOrFail($id);

        $user->delete();

        return back()->with('success', 'User telah dihapus');
    }
}
