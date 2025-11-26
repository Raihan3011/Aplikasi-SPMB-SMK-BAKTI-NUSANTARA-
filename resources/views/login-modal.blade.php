<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-user-tie fa-3x text-success mb-3"></i>
                                <h5>Login sebagai Admin</h5>
                                <p class="text-muted">Untuk staff sekolah yang memiliki akses admin</p>
                                <a href="{{ route('admin.login') }}" class="btn btn-success">Login Admin</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-graduation-cap fa-3x text-primary mb-3"></i>
                                <h5>Login sebagai Siswa</h5>
                                <p class="text-muted">Untuk siswa yang sudah terdaftar</p>
                                <a href="{{ route('siswa.login') }}" class="btn btn-primary">Login Siswa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>