<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use App\Models\Pendaftar;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Coba login sebagai calon siswa terlebih dahulu
        $pendaftar = Pendaftar::where('email', $request->email)
                             ->orWhere('nisn', $request->email)
                             ->first();
        
        if ($pendaftar && $request->password === $pendaftar->nisn) {
            session([
                'user_id' => $pendaftar->id,
                'user_name' => $pendaftar->nama_lengkap,
                'user_role' => 'calon_siswa',
                'user_email' => $pendaftar->email,
                'siswa_logged_in' => $pendaftar->id
            ]);
            
            return redirect()->route('siswa.dashboard');
        }

        // Jika bukan calon siswa, coba login sebagai staff/admin
        $pengguna = Pengguna::where('email', $request->email)
                           ->where('status', 'aktif')
                           ->first();

        if ($pengguna && Hash::check($request->password, $pengguna->password_hash)) {
            session([
                'user_id' => $pengguna->id,
                'user_name' => $pengguna->nama_pengguna,
                'user_role' => $pengguna->role,
                'user_email' => $pengguna->email
            ]);

            return $this->redirectByRole($pengguna->role);
        }

        return back()->withErrors(['login' => 'Email/NISN atau password tidak sesuai']);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }

    private function redirectByRole($role)
    {
        switch ($role) {
            case 'admin_panitia':
                return redirect()->route('admin.dashboard');
            case 'verifikator_administrasi':
                return redirect()->route('verifikator.dashboard');
            case 'keuangan':
                return redirect()->route('keuangan.dashboard');
            case 'kepala_sekolah':
                return redirect()->route('kepala.dashboard');
            default:
                return redirect()->route('login');
        }
    }
}