@section('title')
    {{ $category->name }}
@endsection

@section('shop')
    active
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('front/css/nice-select2.css') }}" />
@endsection

<div class="p-relative">

    @include('partial.component-loading')

    <div class="bradcaump py-4">
        <div class="container">
            <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0">
                <i class="fa fa-home mr-2" aria-hidden="true"></i>Properties</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                {{ $category->name }}</button>
        </div>
    </div>

    <div class="row">
        <div wire:ignore class="product-filter bg-container col-lg-3 col-md-0">
            <div class="d-flex justify-content-end">
                <button class="filter-close btn-lg btn btn-light btn-floating"><i class="fa fa-times"
                        aria-hidden="true"></i>
                </button>
            </div>
            <div class="price mb-4">
                <div class="smallest-font text-black f-500 text-uppercase">PRICE</div>
                <hr class="mt-1 mb-3">
                <div class="">
                    <div id="priceRangeSlider" class="mb-3 front-range-slider"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="smaller-font f-500 m-0">{{ Country()->currency_symbol }}<span id="leftValue">{{ number_format($minPrice,2) }}</span> - {{ Country()->currency_symbol }}<span
                                id="rightValue">{{ number_format($maxPrice, 2) }}</span>
                        </p>
                        <button id="priceFilterBtn" class="btn btn-dark btn-sm" disabled>ok</button>
                    </div>
                </div>
            </div>
            @if ($category->subCategories->count() > 0)
                @if ($category->subCategories->first()->products->count() > 0)
                    <div class="mb-4">
                        <div class="smallest-font text-black f-500 text-uppercase">CATEGORIES</div>
                        <hr class="mt-1 mb-3">
                        <ul class="list-unstyled f-500">
                            @foreach ($category->subCategories as $subCategory)
                                @if ($subCategory->products->count() > 0)
                                    <li>
                                        <a href="{{ route('category', $subCategory->slug) }}"
                                            class="hover-primary-color btn-lg btn btn-transparent shadow-0">{{ $subCategory->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif

            <div class="mb-4">
                <div class="smallest-font text-black f-500 text-uppercase">Feature</div>
                <hr class="mt-1 mb-3">
                <ul class="list-unstyled d-flex flex-wrap f-500">
                    @foreach ($features as $feature)
                        <li>
                            <div class="button-checkbox p-0 mx-1">
                                <input wire:model="feature" class="d-none" type="checkbox" value="{{ $feature->id }}"
                                    id="featureCheck{{ $feature->id }}" />
                                <label  class="btn btn-floatin btn-transparent" title="{!! $feature->name !!}"
                                    for="featureCheck{{ $feature->id }}">

                                    <i style="font-size: 40px" class="{!! $feature->icon !!} "></i>

                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-4">
                <div class="smallest-font text-black f-500 text-uppercase">Size</div>
                <hr class="mt-1 mb-3">
                <ul class="list-unstyled d-flex flex-wrap f-500">
                    @foreach ($sizes as $size)
                        <li>
                            <div class="button-checkbox p-0 mr-3">
                                <input wire:model="size" class="d-none" type="checkbox" value="{{ $size->id }}"
                                    id="sizeCheck{{ $size->id }}" />
                                <label class="btn-box hover-primary-color rounded-circle cursor-pointer"
                                    for="sizeCheck{{ $size->id }}">
                                    {{ $size->size }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="mb-4">
                <div class="form-group @error('category') has-error @enderror">
                    <label for="category">Category <span class="text-danger">*</span></label>
                    <select wire:model.defer='category' class="form-control" id="category">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <div class="mb-4">
                <div class="form-group @error('country') has-error @enderror">
                    <label for="country">Country <span class="text-danger">*</span></label>
                    <select wire:model="country" class="form-control" id="country">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <div class="mb-4">
                <div class="form-group @error('state') has-error @enderror">
                    <label for="state">State <span class="text-danger">*</span></label>
                    <select wire:model="state" class="form-control" id="state">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                    @error('state')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group @error('city') has-error @enderror">
                    <label for="city">City <span class="text-danger">*</span></label>
                    <select wire:model="city" class="form-control" id="city">
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>


        </div>
        <div class="col-lg-9 col-md-12">
            <div class="d-flex justify-content-between align-content-center">

                <div class="" wire:ignore>
                    <select wire:model='sort' class="nice-select">
                        <option {{ $sort == 'latest' ? 'selected' : '' }} value="latest">New first</option>
                        <option {{ $sort == 'oldest' ? 'selected' : '' }} value="oldest">Old First</option>
                        <option {{ $sort == 'a-z' ? 'selected' : '' }} value="a-z">A - Z</option>
                        <option {{ $sort == 'z-a' ? 'selected' : '' }} value="z-a">Z - A</option>
                    </select>
                </div>
            </div>
            <button id="filterToggle" class="mt-4 btn-sm btn btn-transparent btn-lg">
                <i class="fa fa-filter" aria-hidden="true"></i>
                Filter
            </button>
            <div class="row">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        @if ($product->onSaleAttributes->count() > 0)
                            <div class="my-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                @livewire('child.single-product', ['product' => $product], key(time().$product->id))
                            </div>
                        @endif
                    @endforeach

                    <div class="my-4 py-4 pagination-links">
                        {{-- {{ $products->links('pagination') }} --}}
                    </div>
                @else
                    <div class="offset-md-3 mt-4 p-4 col-md-6 col-sm-12 bg-white rounded-5 shadow-5-strong">
                        <div class="p-4 text-center text-uppercase text-danger">
                            <i style="font-size: 80px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <h3 class="small-font f-500 p-4">
                                No Product Found
                            </h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('livewire:load', () => {
        categoryScript();
    });

    window.livewire.on('resetPriceRange', () => {
        $('#priceRangeSlider .ui-slider-handle')[1].style.left = '100%';
        $('#priceRangeSlider .ui-slider-handle')[0].style.left = '0%';
        $('#priceRangeSlider .ui-slider-range')[0].style.width = '100%';
        $('#priceRangeSlider .ui-slider-range')[0].style.left = '0%';
    });

    function categoryScript() {
        const niceSelect = document.querySelector(".nice-select");
        if (niceSelect.style.display != 'none') NiceSelect.bind(niceSelect);

        $('#priceRangeSlider').slider({
            range: true,
            min: @this.minPrice,
            max: @this.maxPrice,
            values: [@this.minPrice, @this.maxPrice],
            step: 10,
            slide: function(event, ui) {
                window.priceUi = ui;
                $("#leftValue").html(ui.values[0]);
                $("#rightValue").html(ui.values[1]);
                $("#priceFilterBtn").prop('disabled', false);
            }
        });

        $("#priceFilterBtn").click(function() {
            @this.minPrice = window.priceUi.values[0];
            @this.maxPrice = window.priceUi.values[1];
            $("#priceFilterBtn").prop('disabled', true);
        });

        $(".pagination-links button").click(function() {
            $(window).scrollTop(0, 100);
        });
    }

</script>

@section('extra-js')
    <script type="text/javascript" src="{{ asset('front/js/nice-select2.js') }}"></script>
@endsection
