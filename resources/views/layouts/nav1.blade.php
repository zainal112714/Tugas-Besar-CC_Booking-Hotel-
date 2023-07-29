@php
    $currentRouteName = Route::currentRouteName();
@endphp
{{-- Sidebar --}}
<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded-circle shadow-1-strong" width="50" height="50" alt=""> AdminGown</div>
    <div class="list-group list-group-flush my-3">
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-transparent second-text nav-link @if($currentRouteName == 'admin.dashboard') active @endif"><i
                class="fas fa-tachometer-alt me-2" ></i>{{ __('Dashboard') }}</a>
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @if($currentRouteName == 'admin.users.index') active @endif"><i
                class="fas fa-project-diagram me-2"></i>{{ __('Users') }}</a>
        <a href="{{ route('admin.bookings.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @if($currentRouteName == 'admin.bookings.index') active @endif"><i
                class="fas fa-chart-line me-2"></i>{{ __('Booking') }}</a>
        <a href="{{ route('admin.gown_packages.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @if($currentRouteName == 'admin.gown_packages.index') active @endif"><i
                class="fas fa-paperclip me-2"></i>{{ __('Gown Package') }}</a>
        <div class="dropdown">
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold dropdown-toggle"
                id="storeDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-shopping-cart me-2"></i>Blog
            </a>
            <div class="dropdown-menu " aria-labelledby="storeDropdown">
                <a href="{{ route('admin.categories.index') }}" class="dropdown-item">
                    <i class="far fa-circle nav-icon"></i> Category
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="dropdown-item">
                    <i class="far fa-circle nav-icon"></i> Add Blog
                </a>
            </div>
        </div>
    </div>
</div>


{{-- nav --}}
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Dashboard</h2>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.show') }}"><i class="mr-2 fas fa-file"></i>
                            {{ __('My profile') }}</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="mr-2 fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
