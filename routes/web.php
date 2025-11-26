<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pendaftar;
use App\Http\Controllers\OtpController;

Route::get('/', function () {
    return view('welcome');
});

// Step 1: Student Registration
Route::get('/daftar-siswa', function () {
    $jurusans = \App\Models\Jurusan::all();
    return view('daftar-siswa', compact('jurusans'));
})->name('daftar-siswa');

Route::post('/daftar-siswa', function () {
    $request = request();
    
    // Validasi email, NISN, dan nomor telepon
    $request->validate([
        'email' => 'required|email',
        'nisn' => 'required|numeric|digits_between:8,12',
        'no_telepon' => 'required|string|regex:/^[0-9]{10,15}$/'
    ]);
    
    // Store student data in session
    session(['student_data' => $request->all()]);
    return redirect()->route('daftar-orangtua');
})->name('daftar-siswa.submit');

// Step 2: Parent Registration
Route::get('/daftar-orangtua', function () {
    // Check if student data exists in session
    if (!session('student_data')) {
        return redirect()->route('daftar-siswa');
    }
    return view('daftar-orangtua');
})->name('daftar-orangtua');

Route::post('/daftar-orangtua', function () {
    $studentData = session('student_data');
    $parentData = request()->all();
    
    // Validasi nomor telepon orangtua
    request()->validate([
        'no_telepon_ayah' => 'required|string|regex:/^[0-9]{10,15}$/'
    ]);
    
    // Save to new database structure
    $pendaftar = Pendaftar::create([
        'nama_lengkap' => $studentData['nama_lengkap'],
        'nisn' => $studentData['nisn'],
        'jurusan_pilihan' => $studentData['jurusan_pilihan'],
        'nama_orangtua' => $parentData['nama_ayah'] . ' / ' . $parentData['nama_ibu'],
        'no_telepon' => $studentData['no_telepon'],
        'email' => $studentData['email'] ?? null,
        'tempat_lahir' => $studentData['tempat_lahir'],
        'tanggal_lahir' => $studentData['tanggal_lahir'],
        'jenis_kelamin' => $studentData['jenis_kelamin'],
        'agama' => $studentData['agama'],
        'alamat' => $studentData['alamat'],
        'asal_sekolah' => $studentData['asal_sekolah'],
        'pekerjaan_orangtua' => $parentData['pekerjaan_ayah'] . ' / ' . $parentData['pekerjaan_ibu'],
        'no_telepon_orangtua' => $parentData['no_telepon_ayah']
    ]);
    
    // Auto create tagihan
    $tagihan = new \App\Models\Tagihan();
    $nomorTagihan = $tagihan->generateNomorTagihan();
    
    \App\Models\Tagihan::create([
        'pendaftar_id' => $pendaftar->id,
        'nomor_tagihan' => $nomorTagihan,
        'jumlah' => 4500000,
        'keterangan' => 'Biaya Pendaftaran PPDB 2026/2027',
        'tanggal_jatuh_tempo' => now()->addDays(30)
    ]);
    
    // Kirim email konfirmasi ke pendaftar
    if ($pendaftar->email) {
        \Mail::to($pendaftar->email)->send(new \App\Mail\PendaftaranBerhasil($pendaftar));
    }
    
    // Kirim notifikasi ke admin
    $adminEmail = env('ADMIN_EMAIL', 'admin@smkbaktinusantara666.sch.id');
    \Mail::to($adminEmail)->send(new \App\Mail\NotifikasiAdmin($pendaftar));
    
    session()->forget('student_data');
    return redirect()->route('terima-kasih');
})->name('daftar-orangtua.submit');

// Simple registration (new)
Route::get('/daftar', function () {
    $jurusans = cache()->remember('jurusans_list', 3600, function () {
        return \App\Models\Jurusan::select('kode_jurusan', 'nama_jurusan')->get();
    });
    return view('daftar-simple', compact('jurusans'));
})->name('daftar');

Route::post('/daftar', function () {
    $request = request();
    
    // Validasi email, NISN, dan nomor telepon
    $request->validate([
        'email' => 'required|email',
        'nisn' => 'required|numeric|digits_between:8,12',
        'no_telepon' => 'required|string|regex:/^[0-9]{10,15}$/',
        'no_telepon_orangtua' => 'required|string|regex:/^[0-9]{10,15}$/'
    ]);
    
    $data = $request->all();
    
    // Save to database
    $pendaftar = Pendaftar::create([
        'nama_lengkap' => $data['nama_lengkap'],
        'nisn' => $data['nisn'],
        'jurusan_pilihan' => $data['jurusan_pilihan'],
        'nama_orangtua' => $data['nama_ayah'] . ' / ' . $data['nama_ibu'],
        'no_telepon' => $data['no_telepon'],
        'email' => $data['email'] ?? null,
        'tempat_lahir' => $data['tempat_lahir'],
        'tanggal_lahir' => $data['tanggal_lahir'],
        'jenis_kelamin' => $data['jenis_kelamin'] === 'Laki-laki' ? 'L' : 'P',
        'agama' => 'Islam',
        'alamat' => $data['alamat'],
        'asal_sekolah' => $data['asal_sekolah'],
        'pekerjaan_orangtua' => 'Wiraswasta',
        'no_telepon_orangtua' => $data['no_telepon_orangtua']
    ]);
    
    // Auto create tagihan
    $tagihan = new \App\Models\Tagihan();
    $nomorTagihan = $tagihan->generateNomorTagihan();
    
    \App\Models\Tagihan::create([
        'pendaftar_id' => $pendaftar->id,
        'nomor_tagihan' => $nomorTagihan,
        'jumlah' => 4500000,
        'keterangan' => 'Biaya Pendaftaran PPDB 2026/2027',
        'tanggal_jatuh_tempo' => now()->addDays(30)
    ]);
    
    // Send emails
    if ($pendaftar->email) {
        \Mail::to($pendaftar->email)->send(new \App\Mail\PendaftaranBerhasil($pendaftar));
    }
    
    $adminEmail = env('ADMIN_EMAIL', 'sultanabdillah2008@gmail.com');
    \Mail::to($adminEmail)->send(new \App\Mail\NotifikasiAdmin($pendaftar));
    
    // Set session notification for admin
    session(['new_registration' => [
        'nama' => $pendaftar->nama_lengkap,
        'jurusan' => $pendaftar->jurusan_pilihan,
        'time' => now()->format('H:i')
    ]]);
    
    return redirect()->route('terima-kasih');
})->name('daftar-simple.submit');

// Keep old multi-step route for backward compatibility
Route::get('/daftar-step', function () {
    return redirect()->route('daftar-siswa');
})->name('daftar-step');

// Admin login routes
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function () {
    $username = request('username');
    $password = request('password');
    
    if ($username === 'admin' && $password === 'admin123') {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    }
    
    return back()->with('error', 'Username atau password salah');
})->name('admin.login.submit');

Route::get('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect('/');
})->name('admin.logout');

// Protected admin routes
Route::get('/admin', function () {
    if (!session('admin_logged_in') && (!session('user_id') || session('user_role') !== 'admin_panitia')) {
        return redirect()->route('login');
    }
    $pendaftars = Pendaftar::orderBy('created_at', 'desc')->get();
    $jurusans = \App\Models\Jurusan::pluck('nama_jurusan', 'kode_jurusan');
    return view('admin.dashboard', compact('pendaftars', 'jurusans'));
})->name('admin.dashboard');

Route::get('/admin/detail/{id}', function ($id) {
    if (!session('admin_logged_in') && (!session('user_id') || session('user_role') !== 'admin_panitia')) {
        return redirect()->route('login');
    }
    $pendaftar = Pendaftar::with('dokumen')->findOrFail($id);
    $jurusan = \App\Models\Jurusan::where('kode_jurusan', $pendaftar->jurusan_pilihan)->first();
    return view('admin.detail', compact('pendaftar', 'jurusan'));
})->name('admin.detail');

Route::get('/admin/dokumen/{id}', function ($id) {
    if (!session('admin_logged_in') && (!session('user_id') || session('user_role') !== 'admin_panitia')) {
        return redirect()->route('login');
    }
    $pendaftar = Pendaftar::with('dokumen')->findOrFail($id);
    return view('admin.dokumen', compact('pendaftar'));
})->name('admin.dokumen');

Route::get('/view-dokumen/{filename}', function ($filename) {
    if (!session('admin_logged_in') && (!session('user_id') || session('user_role') !== 'admin_panitia')) {
        return redirect()->route('login');
    }
    $path = public_path('uploads/dokumen/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('view.dokumen');

Route::get('/cetak-kartu/{id}', function ($id) {
    $pendaftar = Pendaftar::with(['jurusan', 'dokumen'])->findOrFail($id);
    return view('cetak-kartu', compact('pendaftar'));
})->name('cetak.kartu');

Route::delete('/admin/delete/{id}', function ($id) {
    if (!session('admin_logged_in') && (!session('user_id') || session('user_role') !== 'admin_panitia')) {
        return redirect()->route('login');
    }
    Pendaftar::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard');
})->name('admin.delete');

Route::get('/admin/notifications', function () {
    if (!session('admin_logged_in') && (!session('user_id') || session('user_role') !== 'admin_panitia')) {
        return redirect()->route('login');
    }
    $pendaftars = Pendaftar::orderBy('created_at', 'desc')->get();
    return view('admin.notifications', compact('pendaftars'));
})->name('admin.notifications');

Route::get('/terima-kasih', function () {
    return view('terima-kasih');
})->name('terima-kasih');

// Student login routes
Route::get('/siswa/login', function () {
    return view('siswa.login');
})->name('siswa.login');

Route::post('/siswa/login', function () {
    // Cek apakah menggunakan format lama (NISN + nama) atau baru (email/NISN + password)
    if (request()->has('nisn') && request()->has('nama_lengkap')) {
        // Format lama
        $nisn = request('nisn');
        $nama_lengkap = request('nama_lengkap');
        
        $siswa = Pendaftar::where('nisn', $nisn)
                         ->where('nama_lengkap', $nama_lengkap)
                         ->first();
    } else {
        // Format baru
        $emailOrNisn = request('email');
        $password = request('password');
        
        $siswa = Pendaftar::where('email', $emailOrNisn)
                         ->orWhere('nisn', $emailOrNisn)
                         ->first();
        
        // Validasi password harus sama dengan NISN
        if ($siswa && $password !== $siswa->nisn) {
            $siswa = null;
        }
    }
    
    if ($siswa) {
        session([
            'user_id' => $siswa->id,
            'user_name' => $siswa->nama_lengkap,
            'user_role' => 'calon_siswa',
            'user_email' => $siswa->email,
            'siswa_logged_in' => $siswa->id
        ]);
        return redirect()->route('siswa.dashboard');
    }
    
    return back()->with('error', 'Data login tidak ditemukan atau tidak sesuai');
})->name('siswa.login.submit');

Route::get('/siswa/logout', function () {
    session()->flush();
    return redirect('/');
})->name('siswa.logout');

Route::get('/siswa/dashboard', function () {
    if (!session('siswa_logged_in') && (!session('user_id') || session('user_role') !== 'calon_siswa')) {
        return redirect()->route('siswa.login');
    }
    $siswaId = session('siswa_logged_in') ?? session('user_id');
    $siswa = Pendaftar::with(['tagihan.pembayaran', 'dokumen'])->findOrFail($siswaId);
    
    // Cek status verifikasi
    if ($siswa->status_verifikasi === 'pending' || $siswa->status_verifikasi === null) {
        return view('siswa.waiting-verification', compact('siswa'));
    }
    
    if ($siswa->status_verifikasi === 'rejected') {
        return view('siswa.rejected', compact('siswa'));
    }
    
    return view('siswa.dashboard', compact('siswa'));
})->name('siswa.dashboard');

Route::get('/siswa/upload-pembayaran/{tagihan_id}', function ($tagihan_id) {
    if (!session('siswa_logged_in') && (!session('user_id') || session('user_role') !== 'calon_siswa')) {
        return redirect()->route('siswa.login');
    }
    
    $siswaId = session('siswa_logged_in') ?? session('user_id');
    $siswa = Pendaftar::findOrFail($siswaId);
    
    // Cek status verifikasi
    if ($siswa->status_verifikasi === 'pending' || $siswa->status_verifikasi === null) {
        return redirect()->route('siswa.dashboard');
    }
    
    $tagihan = \App\Models\Tagihan::where('id', $tagihan_id)
                                  ->whereHas('pendaftar', function($q) use ($siswaId) {
                                      $q->where('id', $siswaId);
                                  })->firstOrFail();
    
    return view('siswa.upload-pembayaran', compact('tagihan'));
})->name('siswa.upload-pembayaran');

Route::post('/siswa/store-pembayaran/{tagihan_id}', function ($tagihan_id) {
    if (!session('siswa_logged_in') && (!session('user_id') || session('user_role') !== 'calon_siswa')) {
        return redirect()->route('siswa.login');
    }
    
    $siswaId = session('siswa_logged_in') ?? session('user_id');
    $tagihan = \App\Models\Tagihan::where('id', $tagihan_id)
                                  ->whereHas('pendaftar', function($q) use ($siswaId) {
                                      $q->where('id', $siswaId);
                                  })->firstOrFail();
    
    $validated = request()->validate([
        'jumlah_bayar' => 'required|numeric|min:0',
        'tanggal_bayar' => 'required|date',
        'metode_pembayaran' => 'required|string',
        'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'keterangan' => 'nullable|string|max:255'
    ]);
    
    // Upload file
    $file = request()->file('bukti_pembayaran');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/pembayaran'), $filename);
    
    \App\Models\Pembayaran::create([
        'tagihan_id' => $tagihan->id,
        'bukti_pembayaran' => $filename,
        'jumlah_bayar' => $validated['jumlah_bayar'],
        'tanggal_bayar' => $validated['tanggal_bayar'],
        'metode_pembayaran' => $validated['metode_pembayaran'],
        'keterangan' => $validated['keterangan']
    ]);
    
    return redirect()->route('siswa.dashboard')->with('success', 'Bukti pembayaran berhasil diupload dan sedang diverifikasi');
})->name('siswa.store-pembayaran');

Route::get('/siswa/upload-dokumen', function () {
    if (!session('siswa_logged_in') && (!session('user_id') || session('user_role') !== 'calon_siswa')) {
        return redirect()->route('siswa.login');
    }
    
    $siswaId = session('siswa_logged_in') ?? session('user_id');
    $siswa = Pendaftar::findOrFail($siswaId);
    
    // Cek status verifikasi
    if ($siswa->status_verifikasi === 'pending' || $siswa->status_verifikasi === null) {
        return redirect()->route('siswa.dashboard');
    }
    
    return view('siswa.upload-dokumen');
})->name('siswa.upload-dokumen');

Route::post('/siswa/store-dokumen', function () {
    if (!session('siswa_logged_in') && (!session('user_id') || session('user_role') !== 'calon_siswa')) {
        return redirect()->route('siswa.login');
    }
    
    $validated = request()->validate([
        'foto_siswa' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        'kartu_keluarga' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'akta_kelahiran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'ijazah_smp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'surat_sehat' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'surat_kelakuan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
    ]);
    
    $siswaId = session('siswa_logged_in') ?? session('user_id');
    
    // Create uploads directory if not exists
    $uploadPath = public_path('uploads/dokumen');
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    
    $uploadedFiles = [];
    
    foreach ($validated as $key => $file) {
        if ($file) {
            $filename = $siswaId . '_' . $key . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $uploadedFiles[$key] = $filename;
        }
    }
    
    // Save to database
    \App\Models\DokumenSiswa::updateOrCreate(
        ['pendaftar_id' => $siswaId],
        $uploadedFiles
    );
    
    return redirect()->route('siswa.dashboard')->with('success', 'Dokumen berhasil diupload! Total ' . count($uploadedFiles) . ' file telah tersimpan.');
})->name('siswa.store-dokumen');

// Static pages
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/persyaratan', function () {
    return view('persyaratan');
})->name('persyaratan');

Route::get('/jurusan', function () {
    $jurusans = \App\Models\Jurusan::all();
    return view('jurusan', compact('jurusans'));
})->name('jurusan');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Test email route (hapus di production)


// Test email route (hapus di production)
Route::get('/test-email', function () {
    try {
        \Mail::to('sultanabdillah2008@gmail.com')->send(new \App\Mail\TestEmail());
        return 'Email berhasil dikirim! Cek log di storage/logs/laravel.log';
    } catch (Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->name('test-email');

// Test OTP route
Route::get('/test-otp', function () {
    try {
        $otp = rand(100000, 999999);
        \Mail::to('sultanabdillah2008@gmail.com')->send(new \App\Mail\SendOtpMail($otp));
        return 'OTP test berhasil dikirim! Kode: ' . $otp;
    } catch (Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->name('test-otp');

// Test Export route (hapus di production)
Route::get('/test-export', function () {
    try {
        $filters = [
            'status' => request('status'),
            'jurusan' => request('jurusan')
        ];
        
        $filename = 'test-data-pendaftar-' . date('Y-m-d-H-i-s') . '.xlsx';
        
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\PendaftarExport($filters), 
            $filename
        );
    } catch (Exception $e) {
        return 'Export Error: ' . $e->getMessage() . '<br>Line: ' . $e->getLine() . '<br>File: ' . $e->getFile();
    }
})->name('test-export');

// Debug login siswa (hapus di production)
Route::get('/debug-login', function () {
    $pendaftars = Pendaftar::select('id', 'nama_lengkap', 'nisn', 'email')->take(5)->get();
    $html = '<h3>Debug Login Siswa</h3><table border="1"><tr><th>ID</th><th>Nama</th><th>NISN</th><th>Email</th></tr>';
    foreach ($pendaftars as $p) {
        $html .= '<tr><td>' . $p->id . '</td><td>' . $p->nama_lengkap . '</td><td>' . $p->nisn . '</td><td>' . $p->email . '</td></tr>';
    }
    $html .= '</table><br><p>Untuk login, gunakan NISN atau Email sebagai username, dan NISN sebagai password.</p>';
    return $html;
})->name('debug-login');





// OTP routes
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send-otp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify-otp');

// Auth routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Dashboard routes untuk setiap role
Route::get('/verifikator/dashboard', function () {
    if (!session('user_id') || session('user_role') !== 'verifikator_administrasi') {
        return redirect()->route('login');
    }
    return view('verifikator.dashboard');
})->name('verifikator.dashboard');

Route::get('/keuangan/dashboard', function () {
    if (!session('user_id') || session('user_role') !== 'keuangan') {
        return redirect()->route('login');
    }
    
    $stats = [
        'total_tagihan' => \App\Models\Tagihan::sum('jumlah'),
        'lunas' => \App\Models\Tagihan::where('status', 'lunas')->count(),
        'belum_bayar' => \App\Models\Tagihan::where('status', 'belum_bayar')->count(),
        'total_count' => \App\Models\Tagihan::count(),
        'total_terkumpul' => max(
            \App\Models\Tagihan::where('status', 'lunas')->sum('jumlah'),
            \App\Models\Pembayaran::where('status_verifikasi', 'verified')->sum('jumlah_bayar')
        )
    ];
    
    return view('keuangan.dashboard', compact('stats'));
})->name('keuangan.dashboard');

Route::get('/kepala/dashboard', function () {
    if (!session('user_id') || session('user_role') !== 'kepala_sekolah') {
        return redirect()->route('login');
    }
    return view('kepala.dashboard');
})->name('kepala.dashboard');

Route::get('/verifikator/detail/{id}', function ($id) {
    if (!session('user_id') || session('user_role') !== 'verifikator_administrasi') {
        return redirect()->route('login');
    }
    $pendaftar = Pendaftar::findOrFail($id);
    $jurusan = \App\Models\Jurusan::where('kode_jurusan', $pendaftar->jurusan_pilihan)->first();
    return view('verifikator.detail', compact('pendaftar', 'jurusan'));
})->name('verifikator.detail');

Route::get('/kepala/detail/{id}', function ($id) {
    if (!session('user_id') || session('user_role') !== 'kepala_sekolah') {
        return redirect()->route('login');
    }
    $pendaftar = Pendaftar::findOrFail($id);
    $jurusan = \App\Models\Jurusan::where('kode_jurusan', $pendaftar->jurusan_pilihan)->first();
    return view('kepala.detail', compact('pendaftar', 'jurusan'));
})->name('kepala.detail');

Route::get('/kepala/detail-lengkap', function () {
    if (!session('user_id') || session('user_role') !== 'kepala_sekolah') {
        return redirect()->route('login');
    }
    $pendaftars = Pendaftar::orderBy('created_at', 'desc')->get();
    $jurusans = \App\Models\Jurusan::all();
    $stats = [
        'total' => Pendaftar::count(),
        'verified' => Pendaftar::where('status_verifikasi', 'verified')->count(),
        'pending' => Pendaftar::where('status_verifikasi', 'pending')->count(),
        'rejected' => Pendaftar::where('status_verifikasi', 'rejected')->count(),
    ];
    return view('kepala.detail-lengkap', compact('pendaftars', 'jurusans', 'stats'));
})->name('kepala.detail-lengkap');



Route::get('/keuangan/edit-tagihan/{id}', function ($id) {
    if (!session('user_id') || session('user_role') !== 'keuangan') {
        return redirect()->route('login');
    }
    
    $tagihan = \App\Models\Tagihan::with('pendaftar')->findOrFail($id);
    return view('keuangan.edit-tagihan', compact('tagihan'));
})->name('keuangan.edit-tagihan');

Route::put('/keuangan/update-tagihan/{id}', function ($id) {
    if (!session('user_id') || session('user_role') !== 'keuangan') {
        return redirect()->route('login');
    }
    
    $tagihan = \App\Models\Tagihan::findOrFail($id);
    
    $validated = request()->validate([
        'jumlah' => 'required|numeric|min:0',
        'keterangan' => 'required|string|max:255',
        'tanggal_jatuh_tempo' => 'required|date',
        'status' => 'required|in:belum_bayar,lunas'
    ]);
    
    $tagihan->update($validated);
    
    return redirect()->route('keuangan.dashboard')->with('success', 'Tagihan ' . $tagihan->nomor_tagihan . ' berhasil diupdate');
})->name('keuangan.update-tagihan');

Route::get('/keuangan/verifikasi-pembayaran/{id}', function ($id) {
    if (!session('user_id') || session('user_role') !== 'keuangan') {
        return redirect()->route('login');
    }
    
    $pembayaran = \App\Models\Pembayaran::with(['tagihan.pendaftar'])->findOrFail($id);
    return view('keuangan.verifikasi-pembayaran', compact('pembayaran'));
})->name('keuangan.verifikasi-pembayaran');

Route::post('/keuangan/update-verifikasi/{id}', function ($id) {
    if (!session('user_id') || session('user_role') !== 'keuangan') {
        return redirect()->route('login');
    }
    
    $pembayaran = \App\Models\Pembayaran::with('tagihan')->findOrFail($id);
    
    $validated = request()->validate([
        'status_verifikasi' => 'required|in:verified,rejected',
        'catatan_verifikasi' => 'nullable|string|max:255'
    ]);
    
    $pembayaran->update($validated);
    
    // Update status tagihan jika pembayaran diverifikasi
    if ($validated['status_verifikasi'] === 'verified') {
        $pembayaran->tagihan->update(['status' => 'lunas']);
    }
    
    $status = $validated['status_verifikasi'] === 'verified' ? 'diverifikasi' : 'ditolak';
    return redirect()->route('keuangan.dashboard')->with('success', 'Pembayaran berhasil ' . $status);
})->name('keuangan.update-verifikasi');

Route::get('/export/pendaftar', function () {
    // Check if user is logged in and has appropriate role
    $allowedRoles = ['admin_panitia', 'verifikator_administrasi', 'keuangan', 'kepala_sekolah'];
    
    if (!session('user_id') || !in_array(session('user_role'), $allowedRoles)) {
        return redirect()->route('login')->with('error', 'Akses tidak diizinkan');
    }
    
    $filters = [
        'status' => request('status'),
        'jurusan' => request('jurusan')
    ];
    
    $filename = 'data-pendaftar-' . date('Y-m-d-H-i-s') . '.xlsx';
    
    return \Maatwebsite\Excel\Facades\Excel::download(
        new \App\Exports\PendaftarExport($filters), 
        $filename
    );
})->name('export.pendaftar');

Route::post('/verifikator/update-status/{id}', function ($id) {
    if (!session('user_id') || session('user_role') !== 'verifikator_administrasi') {
        return redirect()->route('login')->with('error', 'Unauthorized');
    }
    
    $pendaftar = Pendaftar::findOrFail($id);
    $status = request('status');
    
    if (in_array($status, ['verified', 'rejected', 'pending'])) {
        $pendaftar->update(['status_verifikasi' => $status]);
        
        $statusText = [
            'verified' => 'Terverifikasi',
            'rejected' => 'Ditolak',
            'pending' => 'Pending'
        ];
        
        return redirect()->route('verifikator.dashboard')->with('success', 'Status ' . $pendaftar->nama_lengkap . ' berhasil diubah menjadi ' . $statusText[$status]);
    }
    
    return redirect()->route('verifikator.detail', $id)->with('error', 'Status tidak valid');
})->name('verifikator.update-status');
