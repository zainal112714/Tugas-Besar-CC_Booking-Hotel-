@extends('layouts.guest')

@section('content')
    <section class="h-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">

                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded-circle shadow-1-strong px-3" width="150" height="150" alt="">
                                    </div>

                                    <h4 class="mt-1 mb-5 pb-3 text-center">Welcome Admin Marilocation</h4>

                                    <form action="{{ route('login') }}" method="post">
                                        @csrf

                                        <p>Please login to your account</p>

                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" id="form2Example11" class="form-control"
                                                placeholder="Phone number or email address" required autofocus />
                                            <label class="form-label" for="form2Example11">Username</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="password" id="form2Example22" class="form-control"
                                                required />
                                            <label class="form-label" for="form2Example22">Password</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button type="submit"
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Log
                                                in</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a company</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </section>
@endsection
