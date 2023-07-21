{{-- ==================== HEADER ==================== --}}
<header class="header" id="header">
    <nav class="nav container">
        <a href="{{ route('homepage') }}" class="nav__logo" id="nav__logo">MarieLocation </a>

        <div class="nav__menu">
            <ul class="nav__list" style='margin: 0rem; padding-left:0px'>
                <li class="nav__item">
                    <a href="{{ route('homepage') }}"
                        class="nav__link {{ request()->is('/') ? ' active-link' : '' }}">
                        <i class="bx bx-home-alt"></i>
                        <span class="">Home</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('gown_package.index') }}"
                        class="nav__link {{ request()->is('gown-packages') || request()->is('gown-packages/*') ? ' active-link' : '' }}">
                        <i class="bx bx-building-house"></i>
                        <span>Package Gown</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('blog.index') }}"
                        class="nav__link {{ request()->is('blogs') || request()->is('blogs/*') ? ' active-link' : '' }}">
                        <i class="bx bx-award"></i>
                        <span>Blog</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('contact') }}"
                        class="nav__link {{ request()->is('contact') ? ' active-link' : '' }}">
                        <i class="bx bx-phone"></i>
                        <span>Contact</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- theme -->
        <i class="bx bx-moon change-theme" id="theme-button"></i>

        <a target="_blank" href="https://api.whatsapp.com/send?phone=&text=I want to booking"
            class="button nav__button">Booking Now</a>
    </nav>
</header>
