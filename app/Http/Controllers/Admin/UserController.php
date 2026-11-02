<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Menampilkan daftar staf toko.
     */
    public function index(): View
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Redirect ke index karena form tambah menggunakan Modal Pop-Up.
     */
    public function create(): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    /**
     * Menyimpan data staf baru dari Modal Pop-Up.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:admin,owner,teknisi',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index')
            ->with('status', 'Staf baru berhasil ditambahkan!');
    }

    /**
     * Redirect ke index karena form edit menggunakan Modal Pop-Up.
     */
    public function edit(User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    /**
     * Mengubah data staf dari Modal Pop-Up.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->getKey())],
            'role'     => 'required|in:admin,owner,teknisi',
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('status', 'Data staf berhasil diperbarui!');
    }

    /**
     * Toggle status aktif / nonaktif akun staf.
     */
    public function toggleStatus(User $user): RedirectResponse
    {
        // Proteksi: Cegah akun sendiri dinonaktifkan
        if (Auth::id() === $user->getKey()) {
            return redirect()->back()->withErrors([
                'error' => 'Anda tidak dapat menonaktifkan akun Anda sendiri!'
            ]);
        }

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $statusText = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('status', "Akun {$user->name} berhasil {$statusText}.");
    }

    /**
     * Menghapus akun staf secara permanen dari sistem.
     */
    public function destroy(User $user): RedirectResponse
    {
        // Proteksi: Cegah akun sendiri dihapus
        if (Auth::id() === $user->getKey()) {
            return redirect()->back()->withErrors([
                'error' => 'Anda tidak dapat menghapus akun Anda sendiri!'
            ]);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('status', 'Data staf berhasil dihapus dari sistem.');
    }
}