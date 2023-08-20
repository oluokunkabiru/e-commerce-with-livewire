@if ($editId == '')
    @section($that . '-add')
        active
    @endsection
@endif
@section('title')
    @if ($editId != '') Edit @else Add @endif {{ $thatUp }}
@endsection

<div class="">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">

                <div class="mdc-card">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">
                            @if ($editId != '') Edit @else Add @endif {{ $thatUp }}
                        </h6>
                        <a href="{{ route('dashboard.' . $that) }}" class="">All</a>
                    </div>
                    <div class="template-demo">
                        <form wire:submit.prevent="submit">
                            <div class=" mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                <p class="text-primary text-uppercase">Enter color name or choose a feature</p>
                            </div>
                            <div class="mdc-layout-grid__inner">
                                <div
                                    class="mdc-layout-grid__cell d-flex align-items-center mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='name' id="name">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="name"
                                            class=" {{ $name != '' ? 'mdc-floating-label--float-above' : '' }} mdc-floating-label">Feature
                                            Name</label>
                                    </div>
                                    @error('name')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                    <div id="colorPreview"></div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" type="text"
                                            wire:model.defer='icon' id="icon">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="colorPicker"
                                            class="mdc-floating-label--float-above mdc-floating-label">Icon Class Name
                                        </label>
                                    </div>
                                </div>







                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <button
                                        class="text-uppercase mdc-button mdc-button--raised mdc-ripple-upgraded w-100">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @include('admin.progress-indicator')
                </div>
            </div>
        </div>
    </div>
</div>
@section('extra-js')
    <script>
        document.addEventListener('livewire:load', () => {


            // $('#colorPicker').iconpicker().on('iconpickerSelected', function(e) {
            //     $('.iconpicker-input').val(`<i class="${e.iconpickerValue}"></i>`);
        // });

        });



    </script>
@endsection
