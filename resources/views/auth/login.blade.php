@extends('layouts.guest')

@section('content')
    <section style="background-color: #eee;">
        <div class="container " style="padding-bottom: 45px; padding-top: 40px ">
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col-xl-10">
                        <div class="row g-0">
                            <div class="col-lg-6" id='login'>
                                <div class="card-body p-md-4 mx-md-3">
                                    <div class="text-center">
                                        <img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded-circle shadow-1-strong px-3" width="180" height="150" alt="">
                                    </div>
                                    <br>
                                    <h3 class="mt-1 mb-5 pb-3 text-center">Welcome Admin Marielocation</h3>
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf

                                        <p>Please login to your account!</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11"><b>Username</b></label>
                                            <input type="email" name="email" id="form2Example11" class="form-control"
                                                placeholder="Phone number or email addres" required autofocus />
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example22"><b>Password</b></label>
                                            <input type="password" name="password" id="form2Example22" class="form-control" placeholder="Password..." required autofocus />
                                        </div>

                                        <div class="text-center pt-5 mb-6 pb-8">
                                            <button type="submit"
                                                class="btn btn-primary btn-block fa-lg .text-primary-emphasis mb-3">Log
                                                in</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Visi Misi Marie Location</h4>
                                    <p class="small mb-0">Menjadi penyedia layanan penyewaan gaun dan pakaian pesta terkemuka yang
                                        memberikan pengalaman berbelanja yang unik dan memuaskan untuk setiap pelanggan, serta
                                        menjadi bagian tak tergantikan dalam momen-momen istimewa dalam hidup mereka. Marie Location mencerminkan
                                        komitmen untuk memberikan pengalaman belanja yang istimewa, berkualitas, dan ramah lingkungan,
                                        serta menjadi rekan yang andal dalam momen-momen penting dalam kehidupan pelanggan.
                                    </p>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </section>
@endsection
