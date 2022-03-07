@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-gradient-dark py-7 py-lg-7">
        <div class="container">
            <div class="header-body text-center mt-4 mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                       
                        <img src="{{ asset('panas-books') }}/img/panas-books.png" width="350px" height="280px">
                        <br><br>
                        <h1 class="text-white">{{ __('Bienvenido a la libreria en linea Pana´s Books.') }}</h1>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.headers.cards')
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5"></div>
@endsection
