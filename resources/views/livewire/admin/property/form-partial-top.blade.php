<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
    <div class="mdc-text-field @error('name') input-invalid @enderror">
        <input class="mdc-text-field__input" wire:model.defer='name' id="name">
        <div class="mdc-line-ripple"></div>
        <label for="name"
            class="mdc-floating-label {{ $name != '' ? 'mdc-floating-label--float-above' : '' }}">Name<span
                class="text-danger">*</span></label>
    </div>
    @error('name')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
    <div class="mdc-text-field @error('category') input-invalid @enderror">
        <select wire:model.defer='category' class="mdc-text-field__input" id="category">
            <option value="">

            </option>
            @foreach ($categories as $categoryDt)
                <option {{ $categoryDt['id'] == $category ? 'selected' : '' }} value="{{ $categoryDt['id'] }}">
                    {{ $categoryDt['name'] }}
                </option>
            @endforeach
        </select>
        <div class="mdc-line-ripple"></div>
        <label for="category"
            class="mdc-floating-label {{ $category != '' ? 'mdc-floating-label--float-above' : '' }}">Category<span
                class="text-danger">*</span></label>
    </div>
    @error('category')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
    <div class="mdc-text-field @error('country') input-invalid @enderror">
        <select wire:model="country" class="mdc-text-field__input" id="country">
            <option value=""></option>
            @foreach ($countries as $countrys)
                <option value="{{ $countrys->id }}" {{ $countrys->id == $country ? 'selected' : '' }}>{{ $countrys->name }}</option>
            @endforeach
        </select>
        <div class="mdc-line-ripple"></div>
        <label for="country"
            class="mdc-floating-label {{ $country != '' ? 'mdc-floating-label--float-above' : '' }}">Country<span
                class="text-danger">*</span></label>
    </div>
    @error('country')
        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
    <div class="mdc-text-field @error('state') input-invalid @enderror">
        <select wire:model="state" class="mdc-text-field__input" id="state">
            @foreach ($states as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
        </select>
        <div class="mdc-line-ripple"></div>
        <label for="state"
            class="mdc-floating-label {{ $state != '' ? 'mdc-floating-label--float-above' : '' }}">State<span
                class="text-danger">*</span></label>
    </div>
    @error('state')
        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
    <div class="mdc-text-field @error('city') input-invalid @enderror">
        <select wire:model="city" class="mdc-text-field__input" id="city">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
        <div class="mdc-line-ripple"></div>
        <label for="city"
            class="mdc-floating-label {{ $city != '' ? 'mdc-floating-label--float-above' : '' }}">City<span
                class="text-danger">*</span></label>
    </div>
    @error('city')
        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>





<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
    <div class="mdc-form-field mdc-checkbox-field">
        <div class="mdc-checkbox">
            <input type="checkbox" class="mdc-checkbox__native-control" wire:model.defer='promo' id="promo" />
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
        </div>
        <label for="promo">Promotional</label>
    </div>
    @error('promo')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
    <div class="mdc-form-field mdc-checkbox-field">
        <div class="mdc-checkbox">
            <input type="checkbox" class="mdc-checkbox__native-control" wire:model.defer='featured' id="featured" />
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
        </div>
        <label for="featured">Featured</label>
    </div>
    <div class="mdc-form-field mdc-checkbox-field">
        <div class="mdc-checkbox">
            <input type="checkbox" class="mdc-checkbox__native-control" wire:model.defer='trending' id="trending" />
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
        </div>
        <label for="trending">Trending</label>
    </div>
</div>


<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
    <div class="mdc-form-field mdc-checkbox-field">
        <div class="mdc-checkbox">
            <input type="checkbox" class="mdc-checkbox__native-control" wire:model.defer='discounted' id="discounted" />
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
        </div>
        <label for="discounted">Discounted</label>
    </div>
    <div class="mdc-form-field mdc-checkbox-field">
        <div class="mdc-checkbox">
            <input type="checkbox" class="mdc-checkbox__native-control" wire:model.defer='best_seller'
                id="best_seller" />
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
        </div>
        <label for="best_seller">Best Seller</label>
    </div>
</div>


{{-- <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
    <div class="mdc-text-field @error('model') input-invalid @enderror">
        <input class="mdc-text-field__input" wire:model.defer='model' id="model">
        <div class="mdc-line-ripple"></div>
        <label for="model"
            class="mdc-floating-label {{ $model != '' ? 'mdc-floating-label--float-above' : '' }}">Model</label>
    </div>
    @error('model')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div> --}}

<div
    class="text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('short_description') input-invalid @enderror">
    <span class="text-area-label">Short Description<span class="text-danger">*</span></span>

    <textarea class="mdc-text-field__input" editor="true" wire:ignore data-that="@this"
        data-model='short_description'>{{ $short_description }}</textarea>

    @error('short_description')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>
<div
    class="text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('description') input-invalid @enderror">
    <span class="text-area-label">Description<span class="text-danger">*</span></span>
    <textarea editor="true" class="mdc-text-field__input" wire:ignore data-that="@this"
        data-model='description'>{{ $description }}</textarea>
    @error('description')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>

<div
    class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('keywords') input-invalid @enderror">
    <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea">
        <span class="mdc-floating-label {{ $keywords != '' ? 'mdc-floating-label--float-above' : '' }}"
            id="keywords">Keywords</span>
        <span class="mdc-text-field__ripple"></span>
        <textarea wire:model.defer="keywords" class="mdc-text-field__input" aria-labelledby="keywords" rows="2"
            cols="120">{{ $keywords }}</textarea>
        <span class="mdc-line-ripple"></span>

    </label>

    @error('keywords')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>




{{-- <div
    class="text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('technical_specification') input-invalid @enderror">
    <span class="text-area-label">Technical Specification</span>
    <textarea editor="true" data-model="technical_specification" data-that="@this"
        class="mdc-text-field__input">{{ $technical_specification }}</textarea>
    @error('technical_specification')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>
<div
    class="text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('usage') input-invalid @enderror">
    <span class="text-area-label">Usage</span>
    <textarea editor="true" data-that="@this" data-model="usage" class="mdc-text-field__input">{{ $usage }}</textarea>
    @error('usage')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div> --}}



<div
    class="text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('warrenty') input-invalid @enderror">
    <span class="text-area-label">Warrenty</span>
    <textarea editor="true" data-that="@this" data-model="warrenty"
        class="mdc-text-field__input">{{ $warrenty }}</textarea>

    @error('warrenty')

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>
