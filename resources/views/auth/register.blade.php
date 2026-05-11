@extends('auth.app', ['title' => 'Register'])

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
                <p class="login-box-msg">Register a new membership in to start your session</p>

                <form action="{{ route('proses.register') }}" method="post" enctype="multipart/form-data">
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
                            <input id="name" name="name" type="text"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                placeholder="" />
                            <label for="name">Nama Lengkap</label>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="input-group-text">
                            <span class="bi bi-person"></span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input id="phone" name="phone" type="text"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                placeholder="0812..."
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                            <label for="phone">Nomor Telepon</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-telephone"></span>
                        </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="address" name="address" type="text"
                                class="form-control @error('address')
                                is-invalid
                            @enderror"
                                placeholder="" />
                            <label for="address">Alamat</label>
                        </div>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="input-group-text">
                            <span class="bi bi-pin-map"></span>
                        </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="asal_sekolah" name="asal_sekolah" type="text"
                                class="form-control @error('asal_sekolah')
                                is-invalid
                            @enderror"
                                placeholder="" />
                            <label for="address">Asal Sekolah</label>
                        </div>
                        @error('asal_sekolah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="input-group-text">
                            <span class="bi bi-building"></span>
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

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="avatar" name="avatar" type="file"
                                class="form-control @error('avatar')
                                is-invalid
                            @enderror"
                                placeholder="Masukan Alamat Lengkap" />
                            <label for="avatar">Logo Sekolah</label>
                        </div>
                        @error('avatar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="input-group-text">
                            <span class="bi bi-file-earmark"></span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-outline-primary"><i class="bi bi-box-arrow-right"></i>
                                    Register</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="mb-0">
                    <a href="{{ route('login') }}" class="text-center"> I already have a membership </a>
                </p>
            </div>
        </div>
    </div>
@endsection
