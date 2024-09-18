<!DOCTYPE html>
<html lang="en">

    @include('partials.head')

<body>

    {{-- Header --}}
    @include('partials.header')


    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

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
