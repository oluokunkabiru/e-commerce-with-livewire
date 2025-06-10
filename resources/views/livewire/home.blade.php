@section('title')
    Home
@endsection
@section('home')
    active
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}" />
@endsection

<div class="">
    @include('partial.component-loading')
    <!-- Start Slider Area -->
    <div style="height: 500px;" class="mb-4 slider__container slider--one bg__cat--3">
        @livewire('child.home-slider')
    </div>



    {{-- Country Filter --}}




    {{-- goes here --}}
    @livewire('child.hom-country-property')


</div>

@push('extra-css')
<style>
    #social-links li {
            display: inline-block;
            padding: 5px;
            text-align: center;
            list-style: none;
        }
</style>

@endpush

@section('extra-js')
    <!-- Owl Carousel -->
    <script type="text/javascript" src="{{ asset('front/vendor/owl.carousel.min.js') }}"></script>


    <script>
      document.addEventListener('livewire:load', function() {
          $(".home-slider").owlCarousel({
              loop: true,
              margin: 0,
              nav: true,
              smartSpeed: 1000,
              autoplay: true,
              navText: [
                  '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-left"></i>',
                  '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-right"></i>',
              ],
              autoplayTimeout: 5000,
              autoplayHoverPause: true,
              items: 1,
              dots: true,
              lazyLoad: true,
              responsive: {
                  0: {
                      items: 1,
                  },
                  767: {
                      items: 1,
                  },
                  991: {
                      items: 1,
                  },
              },
          });
          $(".slider__container").css("height", "100%");
  
          $(".product-carousel").owlCarousel({
              loop: false,
              margin: 0,
              nav: true,
              smartSpeed: 1000,
              autoplay: true,
              navText: [
                  '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-left"></i>',
                  '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-right"></i>',
              ],
              autoplayTimeout: 3000,
              autoplayHoverPause: true,
              items: 4,
              dots: false,
              lazyLoad: true,
              responsive: {
                  0: {
                      items: 1,
                  },
                  767: {
                      items: 2,
                  },
                  991: {
                      items: 4,
                  },
              },
          });
  
          $(".brand-carousel").owlCarousel({
              loop: true,
              margin: 0,
              nav: true,
              smartSpeed: 1000,
              autoplay: true,
              navText: [
                  '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-left"></i>',
                  '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-right"></i>',
              ],
              autoplayTimeout: 2000,
              autoplayHoverPause: true,
              items: 6,
              dots: false,
              lazyLoad: true,
              responsive: {
                  0: {
                      items: 2,
                  },
                  767: {
                      items: 4,
                  },
                  991: {
                      items: 6,
                  },
              },
          });
  
          $(".nav-tabs .nav-item .nav-link").first().addClass('active');
          $(".tab-content .tab-pane").first().addClass('show active');
      });
  </script>
@endsection
