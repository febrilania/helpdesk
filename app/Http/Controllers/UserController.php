<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get()
    {
        $users = User::all();
        return view('admin/user', compact('users'));
    }

    public function form_add(){
        return view('admin/add_user');
    }

    public function add(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:users,name|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6', // Password wajib diisi saat tambah user
            'role' => 'required'
        ]);

        // Hash password sebelum disimpan
        $validate['password'] = Hash::make($request->password);

        // Simpan data user ke database
        User::create($validate);

        return redirect()->route('get_user')->with('success', 'Berhasil menambah data');
    }

    public function delete($id)
    {
        $user = User::findORFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'data berhasil dihapus');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin/edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|unique:users,name,' . $id . '|max:255|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required'
        ]);

        try {
            $user = User::findOrFail($id);

            // Jika password diisi, hash sebelum update
            if ($request->filled('password')) {
                $validate['password'] = Hash::make($request->password);
            } else {
                unset($validate['password']);
            }

            $user->update($validate);

            return redirect()->route('get_user')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
