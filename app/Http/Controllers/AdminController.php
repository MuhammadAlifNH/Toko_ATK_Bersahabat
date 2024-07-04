<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Gunakan model UseC

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function listUsers(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $ttl = $request->input('ttl');
    
        $users = User::query()
        ->where('status', '<>', 2) // Exclude owners
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($ttl, function ($query, $ttl) {
                return $query->where('TTL', $ttl);
            })
            ->paginate(10);
    
        return view('admin.users', compact('users', 'search', 'status', 'ttl'));
    }    

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function editUser($id)
{
    $user = User::findOrFail($id);
    if (auth()->user()->status == 2 || $user->status != 1) {
        return view('admin.edit_User', compact('user'));
    }
    return redirect()->route('admin.users')->with('error', 'Unauthorized access');
}

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'TTL' => $request->TTL,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status,
        ]);
    
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }
    
    public function deleteUser($id)
{
    $user = User::findOrFail($id);

    // Cek jika pengguna saat ini adalah admin dan target juga admin, tolak penghapusan
    if (auth()->user()->status == 1 && $user->status == 1) {
        return redirect()->route('admin.users')->with('error', 'Anda tidak dapat menghapus sesama admin.');
    }

    // Cek jika pengguna saat ini adalah admin dan target adalah user
    if (auth()->user()->status == 1 && $user->status == 0) {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Cek jika pengguna saat ini adalah owner
    if (auth()->user()->status == 2) {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    return redirect()->route('admin.users')->with('error', 'Aksi tidak diizinkan.');
}
    
}
