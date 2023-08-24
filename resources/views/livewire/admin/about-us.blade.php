@section('about-us')
    active
@endsection

@section('title')
    About Us
@endsection

<div class="">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <h6 class="card-title">
                        About Us
                    </h6>
                    <div class="template-demo">
                        <form wire:submit.prevent='submit'>

                            <div class="mdc-layout-grid__inner">

                                <div
                                    class="editor-full text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('description') input-invalid @enderror">
                                    <span class="text-area-label">About US<span class="text-danger">*</span></span>
                                    <textarea editor="true" class="mdc-text-field__input" wire:ignore data-that="@this" data-model='about'>{!! $about !!}</textarea>
                                    @error('about')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>



                                <div
                                    class="editor-full text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('description') input-invalid @enderror">
                                    <span class="text-area-label">Our Vision<span class="text-danger">*</span></span>
                                    <textarea editor="true" class="mdc-text-field__input" wire:ignore data-that="@this" data-model='vision'>{!! $vision !!}</textarea>
                                    @error('vision')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>


                                <div
                                    class="editor-full text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('description') input-invalid @enderror">
                                    <span class="text-area-label">Our Mission<span class="text-danger">*</span></span>
                                    <textarea editor="true" class="mdc-text-field__input" wire:ignore data-that="@this" data-model='mission'>{!! $mission !!}</textarea>
                                    @error('mission')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div
                                    class="editor-full text-area-grid mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('description') input-invalid @enderror">
                                    <span class="text-area-label">What We do<span class="text-danger">*</span></span>
                                    <textarea editor="true" class="mdc-text-field__input" wire:ignore data-that="@this" data-model='what_we_do'>{!! $what_we_do !!}</textarea>
                                    @error('what_we_do')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <button wire:loading.attr='disabled' id="submitBtn"
                                        class="mdc-button mdc-button--raised mdc-ripple-upgraded w-100 text-uppercase">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @include('admin.progress-indicator')
                    @if (session()->has('success_msg'))
                        <p class="mt-2 p-1 text-center bg-success text-light">{{ session('success_msg') }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@section('extra-js')
    <script src="{{ mix('js/admin-product.js') }}"></script>
    <script src="{{ asset('common/js/ckeditor.js') }}"></script>

    <script>
        // let textareaData;
        let textareaData = [];


        document.addEventListener('livewire:load', () => {
            ckeditor();

            document.querySelector("#submitBtn").addEventListener('click', () => {
                // eval(textareaData[2]).set(textareaData[1], textareaData[0].getData());
                textareaData.forEach(textarea => {
                    eval(textarea[2]).set(textarea[1], textarea[0].getData());
                });
            });
        });

        Livewire.on('setEditor', () => {
            ckeditor();
        });

        function ckeditor() {
            let textareas = document.querySelectorAll("textarea[editor='true']");

            // ClassicEditor
            //     .create(textarea, {
            //         toolbar: {
            //             items: [
            //                 'bold',
            //                 'italic',
            //                 'link',
            //                 '|',
            //                 'bulletedList',
            //                 'numberedList',
            //                 '|',
            //                 'outdent',
            //                 'indent',
            //                 '|',
            //                 'blockQuote',
            //                 'insertTable',
            //                 'mediaEmbed',
            //                 '|',
            //                 'undo',
            //                 'redo',
            //                 '|',
            //                 'highlight',
            //                 'alignment',
            //                 '|',
            //                 'fontSize',
            //                 'fontBackgroundColor',
            //                 'fontColor',
            //                 '|',
            //                 'htmlEmbed',
            //                 'removeFormat',
            //                 '|',
            //                 'subscript',
            //                 'superscript',
            //                 '|',
            //                 'underline'
            //             ]
            //         },
            //         language: 'en',
            //         table: {
            //             contentToolbar: [
            //                 'tableColumn',
            //                 'tableRow',
            //                 'mergeTableCells'
            //             ]
            //         },
            //         licenseKey: '',
            //     })
            //     .then(editor => {
            //         textareaData = [
            //             editor = editor,
            //             model = textarea.getAttribute("data-model"),
            //             that = textarea.getAttribute("data-that")
            //         ];
            //     });



            textareas.forEach((textarea, key) => {
                ClassicEditor
                    .create(textarea, {
                        toolbar: {
                            items: [
                                'bold',
                                'italic',
                                'link',
                                '|',
                                'bulletedList',
                                'numberedList',
                                '|',
                                'outdent',
                                'indent',
                                '|',
                                'blockQuote',
                                'insertTable',
                                'mediaEmbed',
                                '|',
                                'undo',
                                'redo',
                                '|',
                                'highlight',
                                'alignment',
                                '|',
                                'fontSize',
                                'fontBackgroundColor',
                                'fontColor',
                                '|',
                                'htmlEmbed',
                                'removeFormat',
                                '|',
                                'subscript',
                                'superscript',
                                '|',
                                'underline'
                            ]
                        },
                        language: 'en',
                        table: {
                            contentToolbar: [
                                'tableColumn',
                                'tableRow',
                                'mergeTableCells'
                            ]
                        },
                        licenseKey: '',
                        title: false
                    })
                    .then(editor => {
                        textareaData[key] = [
                            editor = editor,
                            model = textarea.getAttribute("data-model"),
                            that = textarea.getAttribute("data-that")
                        ];
                        // textarea.parentNode.querySelector(".ck-content h1").style.display = "none"
                    });

            });
        }
    </script>
@endsection
