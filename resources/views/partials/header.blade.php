<div class="container-fluid">
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
                                <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('beaches') }}">Beaches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('gallery') }}">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('aboutUs') }}">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
