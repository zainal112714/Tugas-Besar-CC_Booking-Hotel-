@extends('layouts.frontend')

@section('content')
<section>
    <div class="swiper-container gallery-top">
        <div class="swiper-wrapper">
            @foreach($gown_package->galleries as $gallery)
            <section class="islands swiper-slide">
                <img src="{{ Storage::url($gallery->images) }}" alt="" class="islands__bg" />
            </section>
            @endforeach
        </div>
    </div>

    <div class="islands__container container">
        <div class="islands__data" style="text-align: center">
            <h2 class="islands__subtitle">Explore</h2>
            @if($gown_package->galleries->count() > 0)
            <h1 class="islands__title">{{ $gallery->name }}</h1>
            @endif
        </div>
    </div>

    {{-- control--}}
    <div class="controls gallery-thumbs">
        <div class="controls__container swiper-wrapper">
            @foreach($gown_package->galleries as $gallery)
            <img
                src="{{ Storage::url($gallery->images) }}"
                alt=""
                class="controls__img swiper-slide"
            />
            @endforeach
        </div>
    </div>
</section>

<section class="blog section" id="blog">
    <div class="blog__container container">
        <div class="content__container">
            <div class="blog__detail">
                {!! $gown_package->description !!}
            </div>
            <div class="package-travel">
                <h3>Booking Now</h3>
                <div class="card">
                    <form action="{{ route('booking.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="gown_package_id" value="{{ $gown_package->id }}">
                        <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" />
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" />
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <input type="number" name="number_phone" placeholder="Example: 62825566223312" value="{{ old('number_phone') }}" />
                        @error('number_phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <input
                            placeholder="Pick Your Date"
                            class="textbox-n"
                            type="text"
                            name="date"
                            onfocus="(this.type='date')"
                            id="date"
                            value="{{ old('date') }}"
                        />
                        @error('date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <button type="submit" class="button button-booking">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" id="popular">
    <div class="container">
        <span class="section__subtitle" style="text-align: center"
            >Package Gown</span
        >
        <h2 class="section__title" style="text-align: center">
            The Best Tour For You
        </h2>

        <div class="popular__all">
            @foreach($gown_packages as $gown_package)
            <article class="popular__card">
                <a href="{{ route('gown_package.show', $gown_package->slug) }}">
                    @if($gown_package->galleries->count() > 0)
                    <img
                        src="{{ Storage::url($gown_package->galleries->first()->images) }}"
                        alt=""
                        class="popular__img"
                    />@endif
                    <div class="popular__data">
                        <h2 class="popular__price"><span>Rp.</span>{{ number_format($gown_package->price,2) }}</h2>
                        <h3 class="popular__title">{{ $gown_package->size }}</h3>
                        <p class="popular__description">{{ $gown_package->type }}</p>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>

@if(session()->has('message'))
<div id="alert" class="alert">
    {{ session()->get('message') }}
    <i class='bx bx-x alert-close' id="close"></i>
</div>
@endif
@endsection

@push('style-alt')
<style>
    .alert {
        position: absolute;
        top: 120px;
        left: 0;
        right: 0;
        background-color: var(--second-color);
        color: white;
        padding: 1rem;
        width: 70%;
        z-index: 99;
        margin: auto;
        border-radius: .25rem;
        text-align: center;
    }

    .alert-close {
        font-size: 1.5rem;
        color: #090909;
        position: absolute;
        top: .25rem;
        right: .5rem;
        cursor: pointer;
    }
    blockquote {
        border-left: 8px solid #b4b4b4;
        padding-left: 1rem;
    }
    .blog__detail ul li {
        list-style: initial;
    }
</style>
@endpush

@push('script-alt')
<script>
    let galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 0,
        slidesPerView: 0,
    });

    let galleryTop = new Swiper('.gallery-top', {
        effect: 'fade',
        loop: true,

        thumbs: {
            swiper: galleryThumbs,
        },
    });

    const close = document.getElementById('close');
    const alert = document.getElementById('alert');
    if (close) {
        close.addEventListener('click', function() {
            alert.style.display = 'none';
        })
    }
</script>
@endpush
