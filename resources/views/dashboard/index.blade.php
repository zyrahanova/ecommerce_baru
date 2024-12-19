@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="text-center">
        <h1 class="h3 mb-1 text-gray-800">Selamat Datang!!!</h1>
    </div>

    <div class="container">
        <!-- Content Row -->
        <div class="row">
            <div class="d-flex justify-content-center">
                <!-- Carousel -->
                <div id="carouselExampleFade" class="carousel slide carousel-fade w-75">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/images/Asics Gel-Sonoma 15-50 French Blue.jpg" class="img-fluid object-fit-cover"
                                alt="Asics Gel-Sonoma 15-50 French Blue">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/New Era 9Forty Unstructured NYC Black Baseball Cap.png"
                                class="img-fluid object-fit-cover" alt="New Era 9Forty Unstructured NYC Black Baseball Cap">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/Solomon XT-SLATE.png" class="img-fluid object-fit-cover"
                                alt="Solomon XT-SLATE.png">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/MoMA x New Era 9TWENTY Adjustable Baseball Cap.jpg"
                                class="img-fluid object-fit-cover" alt="MoMA x New Era 9TWENTY Adjustable Baseball Cap">
                        </div>
                    </div>

                    <!-- Optional navigation controls (Previous/Next) -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
            <script>
                $.ajax({
                    url: 'https://dummyjson.com/test',
                    method: 'GET',
                    success: function(response) {
                        console.log(response);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            </script>
        </div>
        <!-- (End) carousel -->
    </div>
@endsection
