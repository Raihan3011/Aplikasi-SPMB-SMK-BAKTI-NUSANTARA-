@if(session('user_role') === 'admin_panitia' || session('user_role') === 'verifikator_administrasi' || session('user_role') === 'keuangan')
<div class="dropdown">
    <button class="btn btn-outline-light position-relative" type="button" data-bs-toggle="dropdown" id="notificationBell">
        <i class="fas fa-bell"></i>
        @php
            $notifications = 0;
            if(session('user_role') === 'verifikator_administrasi') {
                $notifications = \App\Models\Pendaftar::where('status_verifikasi', 'pending')->count();
            } elseif(session('user_role') === 'keuangan') {
                $notifications = \App\Models\Pembayaran::where('status_verifikasi', 'pending')->count();
            } elseif(session('user_role') === 'admin_panitia') {
                $notifications = \App\Models\Pendaftar::whereDate('created_at', today())->count();
            }
        @endphp
        @if($notifications > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge">
                {{ $notifications > 99 ? '99+' : $notifications }}
            </span>
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
        <li class="dropdown-header">
            <strong>Notifikasi</strong>
        </li>
        @if(session('user_role') === 'verifikator_administrasi')
            @if($notifications > 0)
                <li><a class="dropdown-item notification-item" href="{{ route('verifikator.dashboard') }}" onclick="markAsRead()">
                    <i class="fas fa-clock text-warning me-2"></i>
                    {{ $notifications }} pendaftar perlu diverifikasi
                </a></li>
            @else
                <li><span class="dropdown-item text-muted">Tidak ada notifikasi</span></li>
            @endif
        @elseif(session('user_role') === 'keuangan')
            @if($notifications > 0)
                <li><a class="dropdown-item notification-item" href="{{ route('keuangan.dashboard') }}" onclick="markAsRead()">
                    <i class="fas fa-money-bill text-success me-2"></i>
                    {{ $notifications }} pembayaran perlu diverifikasi
                </a></li>
            @else
                <li><span class="dropdown-item text-muted">Tidak ada notifikasi</span></li>
            @endif
        @elseif(session('user_role') === 'admin_panitia')
            @if($notifications > 0)
                <li><a class="dropdown-item notification-item" href="{{ route('admin.dashboard') }}" onclick="markAsRead()">
                    <i class="fas fa-user-plus text-primary me-2"></i>
                    {{ $notifications }} pendaftar baru hari ini
                </a></li>
            @else
                <li><span class="dropdown-item text-muted">Tidak ada notifikasi</span></li>
            @endif
        @endif
        @if($notifications > 0)
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-center" href="#" onclick="clearAllNotifications()">
            <small class="text-muted">Tandai semua sudah dibaca</small>
        </a></li>
        @endif
    </ul>
</div>

<script>
function markAsRead() {
    // Hide notification badge
    const badge = document.getElementById('notificationBadge');
    if (badge) {
        badge.style.display = 'none';
    }
    
    // Store in localStorage that notifications were read
    localStorage.setItem('notifications_read_' + '{{ session("user_role") }}', Date.now());
}

function clearAllNotifications() {
    event.preventDefault();
    
    // Hide notification badge
    const badge = document.getElementById('notificationBadge');
    if (badge) {
        badge.style.display = 'none';
    }
    
    // Store in localStorage
    localStorage.setItem('notifications_read_' + '{{ session("user_role") }}', Date.now());
    
    // Close dropdown
    const dropdown = bootstrap.Dropdown.getInstance(document.getElementById('notificationBell'));
    if (dropdown) {
        dropdown.hide();
    }
    
    // Show success message
    const toast = document.createElement('div');
    toast.className = 'toast-container position-fixed top-0 end-0 p-3';
    toast.innerHTML = `
        <div class="toast show" role="alert">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Notifikasi</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                Semua notifikasi telah ditandai sebagai sudah dibaca
            </div>
        </div>
    `;
    document.body.appendChild(toast);
    
    // Auto remove toast after 3 seconds
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Check if notifications were recently read
document.addEventListener('DOMContentLoaded', function() {
    const lastRead = localStorage.getItem('notifications_read_' + '{{ session("user_role") }}');
    const badge = document.getElementById('notificationBadge');
    
    if (lastRead && badge) {
        const readTime = parseInt(lastRead);
        const now = Date.now();
        
        // Hide badge if read within last 5 minutes
        if (now - readTime < 300000) {
            badge.style.display = 'none';
        }
    }
});
</script>
@endif