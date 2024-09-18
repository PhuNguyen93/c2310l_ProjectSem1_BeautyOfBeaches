@extends('layouts.app')

@section('content')
    <!-- Banner -->
    <section class="banner">
        <div class="text-center">Banner or Video</div>

    </section>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Main Section -->
            <div class="col-md-8">
                <!-- Featured Beaches -->
                <h2 class="scroll-in">Featured Beaches</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card beach-card mb-4 scroll-in">
                            <img src="./assets/images/maldives.jpg" class="card-img-top" alt="Beach 1">
                            <div class="card-body">
                                <h5 class="card-title">Maldives Beach</h5>
                                <p class="card-text">A paradise with crystal clear water.</p>
                                <p><span class="rating">★★★★☆</span> (4.5)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card beach-card mb-4 scroll-in">
                            <img src="./assets/images/maldives.jpg" class="card-img-top" alt="Beach 2">
                            <div class="card-body">
                                <h5 class="card-title">Bali Beach</h5>
                                <p class="card-text">Golden sands and endless sunshine.</p>
                                <p><span class="rating">★★★★★</span> (5.0)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Section -->
                <h2 class="scroll-in mt-5">Beach Gallery</h2>
                <div class="row">
                    <div class="col-md-4 scroll-in">
                        <img src="./assets/images/maldives.jpg" class="img-fluid" alt="Gallery Image 1">
                    </div>
                    <div class="col-md-4 scroll-in">
                        <img src="./assets/images/maldives.jpg" class="img-fluid" alt="Gallery Image 2">
                    </div>
                    <div class="col-md-4 scroll-in">
                        <img src="./assets/images/maldives.jpg" class="img-fluid" alt="Gallery Image 3">
                    </div>
                </div>

                <!-- User Feedback Section -->
                <h2 class="scroll-in mt-5">User Feedback</h2>
                <div class="scroll-in">
                    <blockquote class="blockquote">
                        <p>"The most beautiful beach I've ever seen!"</p>
                        <footer class="blockquote-footer">John Doe</footer>
                    </blockquote>
                    <blockquote class="blockquote">
                        <p>"Absolutely stunning, crystal clear waters!"</p>
                        <footer class="blockquote-footer">Jane Smith</footer>
                    </blockquote>
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="col-md-4">
                <!-- Ads Section -->
                <div class="sidebar mt-4 scroll-in">
                    <h3>Sponsored Ads</h3>
                    <img src="./assets/images/maldives.jpg" class="img-fluid" alt="Ad Image 1">
                    <p>Exclusive offers for trips to Maldives!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
