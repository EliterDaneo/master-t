@extends('auth.app', ['title' => 'Login'])

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('welcome') }}"
                    class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0"><b>MASTER</b>T</h1>
                </a>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('proses.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginEmail" name="email" type="email"
                                class="form-control @error('email') is-invalid
                            @enderror"
                                value="" placeholder="" />
                            <label for="loginEmail">Email</label>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginPassword" name="password" type="password"
                                class="form-control @error('password')
                                is-invalid
                            @enderror"
                                placeholder="" />
                            <label for="loginPassword">Password</label>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>
                    <!--begin::Row-->
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-outline-primary"><i
                                        class="bi bi-box-arrow-in-left"></i>
                                    Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center"> Register a new membership </a>
                </p>
            </div>
        </div>
    </div>
@endsection
