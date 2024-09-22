@extends('layout.layout')

@section('content')

    <!-- Hero Section -->
    <x-hero subTitle='Popular Beach Destination' img='{{ asset($beach->image_url) }}' title='{{ $beach->name }}' />
    <!-- End Hero Section -->

    <!-- Start Destination Details Section -->
    <section>
        <div class="cs_height_140 cs_height_lg_80"></div>
        <div class="container">
            <div class="row cs_gap_y_50">
                <div class="col-lg-8">
                    <div class="cs_post_details">
                        <!-- Carousel for Gallery Images -->
                        <div id="beachGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($galleryImages as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image->image_url) }}" class="d-block w-100" alt="{{ $image->caption }}">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p>{{ $image->caption }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#beachGalleryCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#beachGalleryCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <h2>{{ $beach->name }}</h2>
                        <p>{{ $beach->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cs_height_140 cs_height_lg_80"></div>
    </section>
    <!-- End Destination Details Section -->

@endsection
