{{-- ==================== HEADER ==================== --}}
<header class="header" id="header">
    <nav class="nav container">
        <a href="{{ route('homepage') }}" class="nav__logo" id="nav__logo"><img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded-circle shadow-1-strong px-3" width="80" height="80" alt=""> MarieLocation </a>

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

        {{-- thema --}}
        <i class="bx bx-moon change-theme" id="theme-button"></i>

        <a target="_blank" href="https://api.whatsapp.com/send?phone=62859106980431&text=Selamat%20datang%20di%20Marielocation!%20Kami%20sangat%20senang%20Anda%20tertarik%20untuk%20booking%20gaun%20di%20toko%20kami.%20Berikut%20adalah%20beberapa%20informasi%20yang%20kami%20butuhkan%20untuk%20membantu%20Anda%20dengan%20pesanan%20gaun%20impian%20Anda:%0A%0ANama%20Anda:%0ATanggal%20acara:%0AJenis%20acara%20(misalnya,%20pernikahan,%20pesta%20malam,%20wisuda):%0AWarna%20preferensi%20gaun:%0AUkuran%20(pastikan%20untuk%20menyertakan%20ukuran%20tubuh%20Anda%20atau%20referensi%20ukuran%20gaun%20yang%20biasanya%20Anda%20kenakan):%0AGaya%20gaun%20yang%20Anda%20sukai%20(misalnya,%20A-line,%20mermaid,%20ballgown,%20dll.):%0ABudget%20(jika%20Anda%20memiliki%20kisaran%20anggaran%20tertentu):%0AReferensi%20gambar%20atau%20desain%20gaun%20(jika%20ada):%0A%0ASetelah%20kami%20menerima%20informasi%20di%20atas,%20tim%20kami%20akan%20segera%20meninjau%20stok%20gaun%20kami%20dan%20memberikan%20beberapa%20opsi%20yang%20sesuai%20dengan%20preferensi%20Anda.%20Jika%20Anda%20memiliki%20pertanyaan%20tambahan%20atau%20memerlukan%20bantuan%20lainnya,%20jangan%20ragu%20untuk%20bertanya.%0A%0ATerima%20kasih%20atas%20kepercayaan%20Anda%20kepada%20Marie%20location.%20Kami%20berharap%20dapat%20membantu%20Anda%20menemukan%20gaun%20impian%20untuk%20acara%20spesial%20Anda!""
            class="button nav__button">Booking Now</a>
    </nav>
</header>
