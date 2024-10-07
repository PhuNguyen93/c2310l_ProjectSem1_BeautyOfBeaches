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
