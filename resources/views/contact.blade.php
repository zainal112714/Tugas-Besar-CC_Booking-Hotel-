@extends('layouts.frontend')

@section('content')
{{-- ==================== HOME ==================== --}}
<section>
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
            {{-- ========== Hero ========== --}}
            <section class="islands swiper-slide">
              <img
                src="{{ asset('frontend/assets/img/contact-hero.jpg') }}"
                alt=""
                class="islands__bg"
              />
              <div class="bg__overlay">
                <div class="islands__container container">
                  <div class="islands__data">
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
      {{-- ==================== CONTACT ==================== --}}
      <section class="contact section" id="contact">
        <div class="contact__container container grid">
          <div class="contact__images">
            <div class="contact__orbe"></div>

            <div class="contact__img">
              <img src="{{ asset('frontend/assets/img/contact.jpg') }}" alt="" />
            </div>
          </div>

          <div class="contact__content">
            <div class="contact__data">
              <span class="section__subtitle">Pusat Bantuan</span>
              <h2 class="section__title">HUBUNGI KAMI</h2>
              <p class="contact__description">
                Silahkan hubungi jika Anda mempunyai pertanyaan dan mengalami kesulitan.
                Tim layanan kami siap membantu Anda dengan setiap pertanyaan atau permintaan
                yanv Anda miliki.
              </p>
            </div>

            <div class="contact__card">
              <div class="contact__card-box">
                <div class="contact__card-info">
                  <i class="bx bxs-phone-call"></i>
                  <div>
                    <h3 class="contact__card-title">Call</h3>
                    <p class="contact__card-description">022.321.165.19</p>
                  </div>
                </div>

                <button class="button contact__card-button">Call Now</button>
              </div>
              <div class="contact__card-box">
                <div class="contact__card-info">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <div>
                    <h3 class="contact__card-title">Whatsapp</h3>
                    <p class="contact__card-description">022.321.165.19</p>
                  </div>
                </div>

                <button class="button contact__card-button">Chat Now</button>
              </div>
              <div class="contact__card-box">
                <div class="contact__card-info">
                  <i class="bx bxs-video"></i>
                  <div>
                    <h3 class="contact__card-title">Email</h3>
                    <p class="contact__card-description">mrielction
                        @gmail.com</p>
                  </div>
                </div>

                <button class="button contact__card-button">
                  Email Now
                </button>
              </div>
              <div class="contact__card-box">
                <div class="contact__card-info">
                  <i class="bx bxs-phone-call"></i>
                  <div>
                    <h3 class="contact__card-title">Instagram</h3>
                    <p class="contact__card-description">marie_location</p>
                  </div>
                </div>
                <button class="button contact__card-button">Direct Message Now</button>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection
