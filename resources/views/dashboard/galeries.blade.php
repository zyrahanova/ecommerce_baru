@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Galeries</li>
    </ol>
  </nav>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="text-center">
                        <h1 class="h3 mb-1 text-gray-800">Galeries</h1>
                        <p class="mb-4">This the description of the galeries page</p>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <!-- Carousel -->
                            <div id="carouselExample" class="carousel slide w-75">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="/images/gose.png" class="img-fluid object-fit-cover" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/images/jongsajin.jpg" class="img-fluid object-fit-cover" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/images/ver2.jpeg" class="img-fluid object-fit-cover" alt="...">
                                    </div>
                                </div>

                                <!-- Optional navigation controls (Previous/Next) -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <!-- (End) carousel -->

                        <h2 class="mt-3 mb-2 ms-1">Galeries</h2>
                        <div class="d-flex flex-wrap" id="galeries">
                            <img src="/images/skzoo.jpg" class="m-2 img-fluid object-fit-cover" alt=""
                                style="height: 200px;">
                            <img src="/images/skzoo.jpg" class="m-2 img-fluid object-fit-cover" alt=""
                                style="height: 200px;">
                            <img src="/images/skzoo.jpg" class="m-2 img-fluid object-fit-cover" alt=""
                                style="height: 200px;">
                            <img src="/images/skzoo.jpg" class="m-2 img-fluid object-fit-cover" alt=""
                                style="height: 200px;">
                            <img src="/images/skzoo.jpg" class="m-2 img-fluid object-fit-cover" alt=""
                                style="height: 200px;">
                            <img src="/images/skzoo.jpg" class="m-2 img-fluid object-fit-cover" alt=""
                                style="height: 200px;">
                            <img src="/images/skzoo.jpg" class="m-2 img-fluid object-fit-cover" alt=""
                                style="height: 200px;">
                            <img src="/images/skzoo.jpg" class="m-2 img-fluid object-fit-cover" alt=""
                                style="height: 200px;">
                        </div>

                        <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
                        <script>
                            $.ajax({
                                url: 'https://dummyjson.com/test',
                                method: 'GET',
                                success: function (response) {
                                    console.log(response);

                                },
                                error: function (err) {
                                    console.log(err);
                                }
                            });
                        </script>
                    </div>
                </div>
                <!-- /.container-fluid -->
@endsection
