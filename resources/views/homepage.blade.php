@extends('layouts.frontend')

@section('content')
    {{-- ==================== HOME ==================== --}}
    <section>
        <div class="swiper-container">
            <div>
                {{-- ========== Hero 1 ========== --}}
                <section class="heros">
                    <img src="{{ asset('frontend/assets/img/awal.jpg') }}" alt="" class="heros__bg" />
                    <div class="bg__overlay">
                        <div class="heros__container container">
                            <div class="heros__data" style="z-index: 99; position: relative">
                                <h2 class="heros__subtitle">
                                    Discover
                                </h2>
                                <h1 class="heros__title">
                                    The Enchanting World
                                </h1>
                                <p class="heros__description">
                                    It's the perfect time to don a gown and immerse yourself
                                     <br />in the beauty of the wedding realm.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <!--==================== LOGOS ====================-->
    <section class="logos" style="margin-top: 9rem; padding-bottom: 3rem">
        <div class="logos__container container grid">
            <div class="logos__img">
                <img src="{{ asset('frontend/assets/img/av.png') }}" alt="" />
            </div>
            <div class="logos__img">
                <img src="{{ asset('frontend/assets/img/ht1.png') }}" alt="" />
            </div>
            <div class="logos__img">
                <img src="{{ asset('frontend/assets/img/yg.jpg') }}" alt="" />
            </div>
            <div class="logos__img">
                <img src="{{ asset('frontend/assets/img/sg.png') }}" alt="" />
            </div>
        </div>
    </section>

    <!--==================== POPULAR ====================-->
    <section class="section" id="popular">
        <div class="container">
            <span class="section__subtitle" style="text-align: center">Best Choice</span>
            <h2 class="section__title" style="text-align: center">
                Popular Gowns
            </h2>

            <div class="popular__container swiper">
                <div class="swiper-wrapper">
                    @foreach ($Gown_packages as $gown_package)
                        <article class="popular__card swiper-slide">
                            <a href="{{ route('gown_package.show', $gown_package->slug) }}">
                                <img src="{{ Storage::url($gown_package->galleries->first()->images) }}" alt=""
                                    class="popular__img" />
                                <div class="popular__data">
                                    <h2 class="popular__price">
                                        <span>$</span>{{ number_format($gown_package->price, 2) }}
                                    </h2>
                                    <h3 class="popular__title">
                                        {{ $gown_package->size }}
                                    </h3>
                                    <p class="popular__description">{{ $gown_package->type }}</p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                <div class="swiper-button-next">
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="swiper-button-prev">
                    <i class="bx bx-chevron-left"></i>
                </div>
            </div>
        </div>
    </section>


    <!-- blog -->
    <section class="blog section" id="blog">
        <div class="blog__container container">
            <span class="section__subtitle" style="text-align: center">Our Blog</span>
            <h2 class="section__title" style="text-align: center">
                The Best Gowns For You
            </h2>

            <div class="blog__content grid">
                @foreach ($blogs as $blog)
                    <article class="blog__card">
                        <div class="blog__image">
                            <img src="{{ Storage::url($blog->image) }}" alt="" class="blog__img" />
                            <a href="{{ route('blog.show', $blog->slug) }}" class="blog__button">
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>

                        <div class="blog__data">
                            <h2 class="blog__title">
                                {{ $blog->title }}
                            </h2>
                            <p class="blog__description">
                                {{ $blog->excerpt }}
                            </p>

                            <div class="blog__footer">
                                <div class="blog__reaction">
                                    {{ date('d M Y', strtotime($blog->created_at)) }}
                                </div>
                                <div class="blog__reaction">
                                    <i class="bx bx-show"></i>
                                    <span>{{ $blog->reads }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
