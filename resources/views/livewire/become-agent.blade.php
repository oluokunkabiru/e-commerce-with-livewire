<div class="modal fade" wire:ignore id="becomeAgent" data-mdb-backdrop="static" data-mdb-keyboard="false"
tabindex="-1" role="dialog" aria-labelledby="becomeAgentLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <form  wire:submit.prevent='submit'>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="becomeAgentLabel">Become Agent Agreement</h5>
            <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            {!! App\Models\AboutsUs::first()->agreement !!}
        </div>
        <div class="modal-footer">
            <div class="form-check mb-4 mr-auto">
                <input name="remember" class="form-check-input mr-auto" wire:model="agreement" type="checkbox" id="acceptAgrement" />
                <label class="form-check-label" for="acceptAgrement">
                  Accept Agreement
                </label>

                @if($errors->has('agreement'))
                    <p class="text-danger">{{ $errors->first('agreement') }}</p>
                @endif
              </div>

            <button type="submit" class="btn btn-primary">Continue</button>
        </div>
</form>

    </div>
</div>
</div>

@section('extra-js')

<script>

$(document).ready(function() {

Livewire.on("formSubmit", () => {


    payWithPaystack();

})

})



function payWithPaystack() {
var handler = PaystackPop.setup({
    key: "{{ env('PAYSTACK_PUBLIC_KEY') }}",
    email: "{{ auth()->user()->email }}",
    amount: $("#amount").val() * 100,
    currency: "NGN",
    ref: "{{ str_replace(' ', '_', config('app.name')) . '_' . str_pad(rand(10, 10000000000), 10, '0', STR_PAD_LEFT) }}", //matric_no.replace(/\//g, "_")+ Math.floor(Math.random() * 10),
    firstname: "{{ auth()->user()->name }}",
    lastname: " ",
    metadata: {
        custom_fields: [{
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "{{ auth()->user()->phone }}"
            },

            {
                display_name: "Address",
                variable_name: "address",
                value: "{{ auth()->user()->address }}"
            }
        ]
    },
    callback: function(response) {

        if (response.reference != '') {
              Livewire.emit("submit", response);

              Livewire.on("accountDebitCredit", () => {

                swal({
                    title: "Payment Successfully",
                    text: "Your payment of of ₦"+ $("#amount").val() +" is successfull",
                    icon: "success",
                    buttons: true,
                }).then((good) => {
                            if (good) {
                                $('#fundMyAccount').modal('hide'); // Close the modal
                            }
                        });

              }
              )






        }
    },

    onClose: function() {
        // alert('window closed');
        swal({
                    title: "Payment Cancel",
                    text: "{{ 'Your payment of of ₦'. number_format($amount) .' is cancel' }}",
                    icon: "error",
                    buttons: true,
                })



    }
});
handler.openIframe();
}
</script>


@endsection

