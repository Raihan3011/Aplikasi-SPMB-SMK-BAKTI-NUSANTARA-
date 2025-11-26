<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="PPDB Sekolah - Penerimaan Peserta Didik Baru">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'PPDB Sekolah - Penerimaan Peserta Didik Baru')</title>
<link rel="icon" type="image/png" href="{{ asset('images/baknus.png') }}">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<!-- Custom Color Scheme -->
<link href="{{ asset('css/custom-colors.css') }}" rel="stylesheet">

<!-- Custom CSS -->
<style>
    body {
        padding-top: 0;
    }
    
    .navbar {
        padding: 0.25rem 0;
    }
    
    .navbar-brand {
        font-weight: bold;
    }
    
    header.bg-primary {
        padding: 8rem 0;
    }
    
    section {
        padding: 5rem 0;
    }
    
    .hero-section {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 8rem 0;
    }
    
    .feature-box {
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: transform 0.3s ease;
    }
    
    .feature-box:hover {
        transform: translateY(-5px);
    }
    
    .btn-custom {
        padding: 12px 30px;
        font-weight: 500;
        border-radius: 25px;
    }
</style>

@stack('styles')