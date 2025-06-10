<div>
    {{-- Be like water. --}}

    <div class="container row my-4 py-4 product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">
        <div class="row ">
          <div class="col-md-3">
              <div class="form-group @error('category') has-error @enderror">
                  <select wire:model='category' wire:loading.attr="disabled" wire:target="updateFilteredProperties" class="form-control">
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
                  <select wire:model="country"  wire:loading.attr="disabled" wire:target="updateFilteredProperties" class="form-control">
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
                  <select wire:model="state"   wire:loading.attr="disabled" wire:target="updateFilteredProperties" class="form-control">
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
                  <select wire:model="city"  wire:loading.attr="disabled" wire:target="updateFilteredProperties" class="form-control">
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
          <i class="spinner-border spinner-border-sm"></i> <span class="visually-hidd">Please Wait...</span>
     </div>
  
      </div>
  
      <!-- Start Slider Area -->
      @if ($bestSellers->count() > 0)
          <!-- Best Seller -->
          <div class="text-center">
              <h3 class="bigger-font f-500 text-uppercase text__primary">Best Seller</h3>
          </div>
            <div class="container">
              <div class="row">
  
              @foreach ($bestSellers as $bestSeller)
              <div class="my-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                @livewire('child.single-product', ['product' => $bestSeller], key('best_seller_' . $bestSeller->id))
               
            </div>
                        
              @endforeach  
            </div>
          </div>
      @endif
  
      @if ($featureds->count() > 0 || $trendings->count() > 0 || $discounteds->count() > 0)
      <section class="">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs justify-content-center" id="ex1" role="tablist">
          @if ($featureds->count() > 0)
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="featured-link" data-mdb-toggle="tab" href="#featured" role="tab"
                aria-controls="featured" aria-selected="true">Featured</a>
            </li>
          @endif
          @if ($trendings->count() > 0)
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="trending-link" data-mdb-toggle="tab" href="#trending" role="tab"
                aria-controls="trending" aria-selected="false">Trending</a>
            </li>
          @endif
          @if ($discounteds->count() > 0)
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="discounted-link" data-mdb-toggle="tab" href="#discounted" role="tab"
                aria-controls="discounted" aria-selected="false">discounted</a>
            </li>
          @endif
        </ul>
        <!-- Tabs navs -->
        <!-- Tabs content -->
        <div class="tab-content" id="ex1-content">
          @if ($featureds->count() > 0)
            <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-link">
              <div class="slide__container py-4 my-4 slider__activation__wrap owl-carousel product-carousel">
                @foreach ($featureds as $featured)
                  <div wire:key='feature_{{ $loop->index }}' class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                      <div class="row align-items__center">
                        <div class="col-md-12">
                          <div class="slide">
                            <div class="slider__inner">
                              <div class="my-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                @livewire('child.single-product', ['product' =>
                                $featured],
                                key("feature_vb_".$loop->index))
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif
          @if ($trendings->count() > 0)
            <div class="tab-pane fade" id="trending" role="tabpanel" aria-labelledby="trending-link">
              <div class="row">
                <div class="slide__container py-4 my-4 slider__activation__wrap owl-carousel product-carousel">
                  @foreach ($trendings as $trending)
                    <div wire:key='trending_{{ $loop->index }}' class="single__slide animation__style01 slider__fixed--height">
                      <div class="container">
                        <div class="row align-items__center">
                          <div class="col-md-12">
                            <div class="slide">
                              <div class="slider__inner">
                                <div class="my-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                  @livewire('child.single-product', ['product' =>
                                  $trending], key("trending_vb_".$loop->index))
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          @endif
          @if ($discounteds->count() > 0)
            <div class="tab-pane fade" id="discounted" role="tabpanel" aria-labelledby="discounted-link">
              <div class="row">
                <div class="slide__container py-4 my-4 slider__activation__wrap owl-carousel product-carousel">
  
                  @foreach ($discounteds as $discounted)
                    <div wire:key='discounted_{{ $loop->index }}' class="single__slide animation__style01 slider__fixed--height">
                      <div class="container">
                        <div class="row align-items__center">
                          <div class="col-md-12">
                            <div class="slide">
                              <div class="slider__inner">
                                <div class="my-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                  @livewire('child.single-product', ['product' =>
                                  $discounted], key("discounted_vb_".$loop->index))
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          @endif
        </div>
        <!-- Tabs content -->
      </section>
    @endif
</div>
