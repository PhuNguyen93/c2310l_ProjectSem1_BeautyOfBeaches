<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Beaches</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <style>
        .banner {
            background: url('https://example.com/banner.jpg') no-repeat center center;
            background-size: cover;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .beach-card {
            transition: transform 0.3s ease-in-out;
        }

        .beach-card:hover {
            transform: scale(1.05);
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .sidebar {
            background-color: #f8f9fa;
            padding: 15px;
            margin-top: 20px;
            border-radius: 10px;
        }

        /* Scroll Animation */
        .scroll-in {
            opacity: 0;
            transform: translateY(50px);
            transition: all 1s ease;
        }

        .scroll-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="bg-primary text-white p-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex justify-content-start">
                    <h1>Beautiful Beaches</h1>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <div>
                        <h3>Visitor Statistics</h3>
                        <p>Total Visitors: 200,543</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center text-md-start mt-2">
                    <nav class="navbar navbar-expand-lg navbar-light bg-primary mt-2">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="#">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="#">Beaches</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="#">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="#">Feedback</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>


    <!-- Banner -->
    <section class="banner">
        <div class="text-center">Explore the Best Beaches Around the World</div>

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

    <footer class="bg-primary text-white pb-0">
        <div class="container">
            <div class="row py-5">
                <div class="col-md pr-md-5 mb-4 mb-md-0">
                    <h3>About Us</h3>
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Laboriosam itaque unde facere repellendus, odio et iste voluptatum
                        aspernatur ratione mollitia tempora eligendi maxime est,
                        blanditiis accusamus. Incidunt, aut, quis!
                    </p>
                    <ul class="list-unstyled quick-info mb-4">
                        <li>
                            <a href="#" class="d-flex align-items-center text-white"><span
                                    class="icon mr-3 icon-phone"></span> +1 291 3912 329</a>
                        </li>
                        <li>
                            <a href="#" class="d-flex align-items-center text-white"><span
                                    class="icon mr-3 icon-envelope"></span>
                                info@gmail.com</a>
                        </li>
                    </ul>

                    <form action="#" class="subscribe d-flex">
                        <input type="text" class="form-control me-2 w-75" placeholder="Enter your e-mail" />
                        <input type="submit" class="btn btn-primary" value="Send" />
                    </form>
                </div>

                <div class="col-md mb-4 mb-md-0">
                    <h3>Latest Tweet</h3>
                    <ul class="list-unstyled">
                        <li class="d-flex">
                            <div class="mr-4"><span class="icon icon-twitter"></span></div>
                            <div>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Facere unde omnis veniam porro excepturi.
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="mr-4"><span class="icon icon-twitter"></span></div>
                            <div>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Facere unde omnis veniam porro excepturi.
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="mr-4"><span class="icon icon-twitter"></span></div>
                            <div>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Facere unde omnis veniam porro excepturi.
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4 mb-md-0">
                    <h3>Instagram</h3>
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="#"><img src="./assets/images/maldives.jpg" alt="Image"
                                    class="img-fluid" /></a>
                            <a href="#"><img src="./assets/images/maldives.jpg" alt="Image"
                                    class="img-fluid" /></a>
                        </div>
                        <div class="col-6">
                            <a href="#"><img src="./assets/images/maldives.jpg" alt="Image"
                                    class="img-fluid" /></a>
                            <a href="#"><img src="./assets/images/maldives.jpg" alt="Image"
                                    class="img-fluid" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            // Scroll animation
            $(window).on('scroll', function() {
                $('.scroll-in').each(function() {
                    if ($(this).offset().top < $(window).scrollTop() + $(window).height() - 100) {
                        $(this).addClass('visible');
                    }
                });
            });
        });
    </script>

</body>

</html>
