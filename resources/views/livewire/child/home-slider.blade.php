<div class="animated-carousel slide__container slider__activation__wrap home-slider owl-carousel" style="display: block !important;">
    @if ($sliders->count() > 0)
        @foreach ($sliders as $key => $slider)
            <div class="container-fluid">
                <div  style="display:block" wire:key='{{ $key }}' class="single__slide animation__style01 slider__fixed--height">
                    <div class="align-items__center">
                        <div class="slide__thumb w-100" style="position: relative;">
                            <img class="img-fluid" style="width: 100%; object-fit: cover;" src="{{ $slider->getMedia('slider')->first() != null ? $slider->getMedia('slider')->first()->getFullUrl() : null }}">
                            <div class="caption-overlay" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #fff;">
                                <h2 class="big-font">{{ $slider->sub_heading }}</h2>
                                <h1>{{ $slider->heading }}</h1>
                                <a class="btn btn-lg btn-light btn__primary" href="{{ $slider->link }}">{{ $slider->link_text }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
