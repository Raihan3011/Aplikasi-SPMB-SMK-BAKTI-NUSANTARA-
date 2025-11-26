<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>Beranda
                </a>
            </li>
            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item active" aria-current="page">
                    @if(isset($breadcrumb['icon']))
                        <i class="{{ $breadcrumb['icon'] }} me-1"></i>
                    @endif
                    {{ $breadcrumb['title'] }}
                </li>
            @endforeach
        </ol>
    </div>
</nav>