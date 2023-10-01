@section('title')
  Shop
@endsection

@section('shop')
  active
@endsection

@section('contents')
  <div class="p-relative">
    @include('partial.component-loading')
    <div class="bradcaump py-4">
      <div class="container">
        <a href="{{ route('home') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-home mr-2"
            aria-hidden="true"></i>Home</a>
        <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
            aria-hidden="true"></i></button>
        <button class="btn btn-lg btn-transparent p-3 shadow-0">
          Properties</button>
      </div>
    </div>





    <div class="container row my-4 py-4 product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">


        <div class="row ">
            <div class="col-md-3">
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

            <div class="col-md-3">
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


            <div class="col-md-3">
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

            <div class="col-md-3">
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

    </div>
    
    <div class="container py-4 mt-4">



      <div class="row">
        @if ($categories->count() > 0)
          @foreach ($categories as $category)
            <div wire:key='{{ $loop->index }}' class="my-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">
                <a class="btn mb-1 btn-light p-0 shadow-0" href="{{ route('category', $category->slug) }}">
                    <img
                    style="width:100%; height:150px; object-fit:cover"
                    observe='true' observe-src="{{ $category->getMedia('category')->first() !=null ? $category->getMedia('category')->first()->getFUllUrl():null }}" class="img-fluid" alt="">
                  <div style="height: 395px;" class="img-progress">
                    <div class="spinner-border text__primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
                </a>
                <h1 class="small-font my-3">{{ $category->name }}</h1>
                <p class="smaller-font pb-4">{{ $category->products_count }}
                  Propert{{ $category->products_count > 1 ? 'ies' : 'y' }}</p>
              </div>
            </div>
          @endforeach

        @else
          @include('partial.empty-table', ["title" => "No Category Found"])
        @endif
      </div>
    </div>
  </div>
@endsection
