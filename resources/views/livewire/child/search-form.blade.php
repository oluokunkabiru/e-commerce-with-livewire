<form  id="searchProductForm" class="d-flex p-4">



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

        <div class="my-3">
             <input type="search" id="searchProduct" class="rounded form-control my-3">
        </div>





        <div class="row">
            <button class="btn btn__primary col-5">
                Search
                <i wire:loading.class='d-none' class="fa fa-search" aria-hidden="true"></i>
                <div wire:loading.class.remove='d-none' class="spinner-border d-none spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>



            <button type="button" id="searchClose" class="btn btn-danger btn-floating ml-3 col-3">
               <i class="fa fa-times" aria-hidden="true"></i>
            </button>

        </div>



    </div>

</form>




@push('extra-js')
    

    

<script>
    $("#searchProduct").autocomplete({
        minLength: 3,
        source: "{{ route('searchTags') }}",
    });
    $("#searchProductForm").on('submit', function(e) {
        e.preventDefault();
        @this.search = $("#searchProduct").val();
    });

</script>
@endpush
