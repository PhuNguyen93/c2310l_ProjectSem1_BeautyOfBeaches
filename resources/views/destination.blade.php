@extends('layout.layout')

@section('content')
    <!-- Start Hero Section -->
    <section class="cs_hero cs_style_1 cs_center cs_primary_bg cs_ripple_activate"
        style="background-image: url('https://plus.unsplash.com/premium_photo-1669748157617-a3a83cc8ea23?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') ">
        <div class="container">
            <div class="cs_hero_text text-center">
                <h1 class="cs_hero_title cs_white_color cs_fs_100 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                    Destinations</h1>
            </div>

            <div class="cs_find_form_wrap">
                <form id="searchForm" class="cs_find_form">
                    <div>
                        <select name="country" class="st_select">
                            <option value="">Country</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="India">India</option>
                            <option value="United States">United States</option>
                            <option value="Germany">Germany</option>
                            <option value="Australia">Australia</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Italy">Italy</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Greece">Greece</option>
                            <option value="Spain">Spain</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Philippines">Philippines</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Egypt">Egypt</option>
                        </select>
                    </div>

                    <div>
                        <select name="direction" class="st_select">
                            <option value="">Direction</option>
                            <option value="East">East</option>
                            <option value="West">West</option>
                            <option value="South">South</option>
                            <option value="North">North</option>
                            <option value="North">North East</option>
                            <option value="North">North West</option>
                            <option value="North">South East</option>
                            <option value="North">South West</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="cs_find_btn cs_bold cs_primary_font cs_center">
                            <i class="fa-solid fa-magnifying-glass"></i> Find Now
                        </button>
                    </div>
                </form>
            </div>
        </section>
            <!-- Start destination Section -->
            <section>
                <div class="cs_height_140 cs_height_lg_80"></div>
                <div class="container" id="results">
                    <div class="cs_grid_1">
                        @if($beaches->isEmpty())
                            <p>No beaches found for your search.</p>
                        @else
                            @foreach ($beaches as $beach)
                                <div class="cs_grid_item">
                                    <a href="{{ route('destinationdetails', ['id' => $beach->id]) }}"
                                        class="cs_card cs_style_2 cs_zoom position-relative cs_radius_8">
                                        <div class="cs_card_thumb w-100 h-100">
                                            <img src="{{ asset($beach->image_url) }}" alt="Card Image" class="w-100 h-100 cs_zoom_in">
                                        </div>
                                        <div class="cs_card_content position-absolute">
                                            <h2 class="cs_card_title cs_fs_35 cs_medium cs_white_color">{{ $beach->name }}</h2>
                                            <p class="cs_card_subtitle cs_fs_18 cs_medium cs_white_color mb-0">{{ $beach->country }}</p>
                                            @php
                                                $totalReviews = $beach->feedbacks->count();
                                                $averageRating = $totalReviews > 0 ? round($beach->feedbacks->avg('rating'), 1) : 0;
                                            @endphp
                                            <p class="cs_card_subtitle cs_fs_18 cs_medium cs_white_color mb-0">
                                                Rating:
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $averageRating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-warning"></i>
                                                    @endif
                                                @endfor
                                                ({{ $totalReviews }} reviews)
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    {{ $beaches->links('pagination::bootstrap-5') }}
                </div>
                <div class="cs_height_140 cs_height_lg_80"></div>
            </section>
            <!-- End destination Section -->

        </div>
        <div class="cs_hero_shape_1"></div>
        <div class="cs_hero_shape_2"></div>
        <div class="cs_hero_shape_3"></div>
      </div>
    </section>
    <!-- End Hero Section -->



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của form

                $.ajax({
                    url: "{{ route('searchBeaches') }}",
                    method: 'GET',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#results').html(response);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            });
        });
    </script>
@endsection









