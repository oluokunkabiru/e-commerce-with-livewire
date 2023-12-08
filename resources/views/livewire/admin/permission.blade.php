@section('title')
@endsection

<div class="">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <h6 class="card-title">
                        Roles And Permissions
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field @error('role') input-invalid @enderror">
                                <select wire:model.defer='role'  wire:change="loadRolePermissions" class="mdc-text-field__input" id="category">
                                    @foreach ($roles as $rol)
                                        <option {{ $rol->name == $role ? 'selected' : '' }} value="{{ $rol->name }}">
                                            {{ $rol->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="mdc-line-ripple"></div>
                                <label for="category"
                                    class="mdc-floating-label {{ $role != '' ? 'mdc-floating-label--float-above' : '' }}">Role<span
                                        class="text-danger">*</span></label>
                            </div>
                            @error('role')
                                <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                    </h6>
                    <div class="template-demo">

                        <form wire:submit.prevent='submit'>

                            <div class="mdc-layout-grid__inner">
                                @foreach ($permissions as $permit)
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop">
                                    <div class="mdc-checkbox">
                                        <input type="checkbox" class="mdc-checkbox__native-control" id="{{ $permit->id }}"
                                            wire:model="selectedPermissions" value="{{ $permit->name }}" />
                                        <div class="mdc-checkbox__background">
                                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                <path class="mdc-checkbox__checkmark-path" fill="none"
                                                    d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                            </svg>
                                            <div class="mdc-checkbox__mixedmark"></div>
                                        </div>
                                    </div>
                                    <label for="{{ $permit->id }}">{{ ucwords($permit->name) }}</label>
                                </div>
                            @endforeach







                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <button class="tup mdc-button mdc-button--raised mdc-ripple-upgraded w-100">
                                        Save
                                    </button>
                                </div>
                            </div>


                        </form>
                        @include('admin.progress-indicator')
                        @if (session()->has('success_msg'))
                            <p class="mt-2 p-1 text-center text-uppercase bg-success text-light">
                                {{ session('success_msg') }}
                            </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
