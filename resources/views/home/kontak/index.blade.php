@extends('components.layouts.front.app', ['Kontak Kami'])

@section('content')
    <header class="pt-5 border-bottom bg-light">
        <div class="container pt-md-1 pb-md-1">
            <h1 class="bd-title mt-4 font-weight-bold"><i class="bi bi-telephone" aria-hidden="true"></i> KONTAK
            </h1>
            <p class="bd-lead">Kontak Master-T.</p>
        </div>
    </header>

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('welcome') }}" class="text-decoration-none"><i class="bi bi-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-decoration-none"><i class="bi bi-telephone"></i>
                    Kontak Kami</a>
            </li>
        </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container mt-3 mb-5">
        <div class="row">

            <div class="col-md-7" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7919.292791494065!2d110.4102916003752!3d-7.05077155011837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1778147201216!5m2!1sen!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-5" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>KONTAK KAMI</h3>
                        <hr>
                        <p>
                            <i class="fa fa-map-marker" aria-hidden="true"></i> Jl. KH Ahmad Dahlan No 6, Kab Wonosobo, Jawa
                            Tengah <br>

                            <i class="bi bi-telephone"></i> +62857-8585-2224 <br>

                            <i class="bi bi-envelope"></i> info@tefa.sch.id
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
