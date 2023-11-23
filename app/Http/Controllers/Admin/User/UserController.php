<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::orderBy('updated_at', 'desc')->get();
        return view('admin.user.index', compact('users', 'roles')); // resources/views/admin/user/index.blade.php
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
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:255',
            'role' => 'required|exists:roles,id',
            'phone' => 'required|min:10|max:11',
        ]);

        $role = $data['role'];
        unset($data['role']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $r = Role::where('id', $role)->first();
        if ($user)
        {
            $user->assignRole($r->name);
            return redirect()->back()->with('success', 'Kullanıcı başarıyla oluşturuldu.');
        }
        else
            return redirect()->back()->with('error', 'Kullanıcı oluşturulurken bir hata oluştu.');
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
    public function edit(User $user): \Illuminate\Http\JsonResponse
    {
        return response()->json(['user' => $user, 'roles' => Role::orderBy('updated_at', 'desc')->get()]); // resources/views/admin/user/edit.blade.php
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user = User::where('id', $user->id)->first();
        if (!$user)
            return response()->json(['status' => false, 'message' => 'Kullanıcı bulunamadı.']);
        $delete = $user->delete();
        if ($delete)
            return response()->json(['status' => true, 'message' => 'Kullanıcı başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Kullanıcı silinirken bir hata oluştu.']);
    }
}
