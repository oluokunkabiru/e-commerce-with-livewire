<div class="container row my-4 py-4 product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">


    <div class="row ">
        <div class="col-md-3">
            <div class="form-group @error('category') has-error @enderror">
                <select wire:model='category' wire:loading.attr="disabled" class="form-control">
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

        <div class="col-md-3">
            <div class="form-group @error('country') has-error @enderror">
                <select wire:model="country" wire:loading.attr="disabled" class="form-control" id="country">
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


        <div class="col-md-3">
            <div class="form-group @error('state') has-error @enderror">
                <select wire:model="state"  wire:loading.attr="disabled" class="form-control" id="state">
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

        <div class="col-md-3">
            <div class="form-group @error('city') has-error @enderror">
                <select wire:model="city"  wire:loading.attr="disabled"class="form-control" id="city">
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

    <div wire:loading role="status">
        <i class="spinner-border spinner-border-sm"></i> <span class="visually-hidden">Please Wait...</span>
   </div>

    {{-- <div class="row mt-3">
        <div class="col-md-3">
            <div class="form-group @error('city') has-error @enderror">
                <select wire:model='sort' class="nice-select">
                    <option {{ $sort == 'latest' ? 'selected' : '' }} value="latest">New first</option>
                    <option {{ $sort == 'oldest' ? 'selected' : '' }} value="oldest">Old First</option>
                    <option {{ $sort == 'a-z' ? 'selected' : '' }} value="a-z">A - Z</option>
                    <option {{ $sort == 'z-a' ? 'selected' : '' }} value="z-a">Z - A</option>
                </select>
                @error('sort')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group @error('city') has-error @enderror">
                <select wire:model="city" class="form-control" id="city">
                    <option value="">Feature</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group @error('city') has-error @enderror">
                <select wire:model="city" class="form-control" id="city">
                    <option value="">Land Size</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group @error('city') has-error @enderror">
                <label for="priceRange">Price Range <span class="text-danger">*</span></label>
                <input step="0.5" wire:model="priceRange" type="range" class="form-range" min="0" max="5" id="priceRange">
                <p class="smaller-font f-500 m-0">{{ Country()->currency_symbol }}<span id="leftValue">{{ number_format($minPrice,2) }}</span> - {{ Country()->currency_symbol }}<span
                    id="rightValue">{{ number_format($maxPrice, 2) }}</span>
            </p>
                @error('priceRange')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        

        
    </div> --}}







    <div class="container py-4 mt-4">



        <div class="row">
                 @if (count($properties) > 0)
                     @foreach ($properties as $product)
                         @if ($product->onSaleAttributes->count() > 0)
                             <div class="my-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                 @livewire('child.single-product', ['product' => $product], key(time().$product->id))
                                 {{-- @livewire('child.single-product', ['product' => $product], key(time().$product->id)) --}}
                                 {{-- @livewire('child.single-product', ['product' =>
                                 $product], key($loop->index)) --}}
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
                                 No Property Found
                             </h3>
                         </div>
                     </div>
                 @endif
             </div>      
     </div>
   </div>
</div>