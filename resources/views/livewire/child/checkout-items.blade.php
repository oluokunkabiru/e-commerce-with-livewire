<div>

    @include('partial.component-loading')

    <h5 class="smaller-font text-uppercase text-center mb-4">Enquiry properties</h5>

    @foreach ($carts as $cart)
        <div class="my-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('property.detail', $cart->property->slug) . '?attribute=' . $cart->attribute->id }}"
                class="btn btn-transparent p-0 shadow-0">
                <img src="{{ $cart->attribute->getMedia('products')->first() !=null ? $cart->attribute->getMedia('products')->first()->getFUllUrl():null }}" alt="" width="60px" class="img-fluid">
            </a>
            <div class="">
                <p class="smallest-font mb-0">{{ $cart->property->name }}({{ $cart->qty }})</p>
                <p class="smallest-font f-500 m-0">{{ Country()->currency_symbol }}{{ ($cart->attribute->price+(0.01*settings()->agent_fee*$cart->attribute->price)) * $cart->qty }}</p>
            </div>
            <button data-id="{{ $cart->id }}" class="remove-button btn btn-floating shadow-0 btn-transparent">
                <i class="fa fa-trash-alt" aria-hidden="true"></i>
            </button>
        </div>
    @endforeach
    <div class="mt-4 text-uppercase">
        <div class="d-flex justify-content-between">
            <p>Property Total</p>
            <p class="f-500">{{ Country()->currency_symbol }}{{ $subTotal }}</p>
        </div>



        @if ($appliedCouponExtra > 0)
            <div class="d-flex justify-content-between">
                <p>Coupon Extra</p>
                <p class="f-500">{{ Country()->currency_symbol }}{{ $appliedCouponExtra }}</p>
            </div>
        @endif
        <hr>
        
        <div class="d-flex justify-content-between">
            <p>Total</p>
            <p class="f-500">{{ Country()->currency_symbol }}{{ $total }}</p>
        </div>
        <div>
            <form wire:submit.prevent='submit' class="d-flex">
                <div class="form-group mb-3 row">
                    <div class="col-md-12 my-2">                
                        <input placeholder="Apply Coupon" wire:model.defer="coupon" type="text" class="form-control">
                    </div>
                    <div class="col-md-12 my-2">                
                        <input placeholder="Referral Code" wire:model="referral_code" type="text" class="form-control">
                    </div>
                <button class="btn btn-dark">Ok</button>
                </div>
            </form>

            
            @error('coupon')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (session()->has('success_msg'))
                <p class="text-success">{{ session('success_msg') }}</p>
            @endif
            @if (session()->has('error_msg'))
                <p class="text-danger">{{ session('error_msg') }}</p>
            @endif
        </div>
    </div>

</div>


<script>
    document.querySelectorAll("button.remove-button").forEach((el) => {
        el.addEventListener('click', () => {
            swal({
                    title: "Are you sure?",
                    text: "You can't undo this action.",
                    icon: "warning",
                    buttons: true,
                })
                .then((willDelete) => {
                    willDelete && Livewire.emit('delete', el.getAttribute('data-id'));
                });
        });
    });

</script>


@push('extra-js')
    {{-- <script src="https://js.paystack.co/v1/inline.js"></script> --}}


    <script>
        $(document).ready(function ()
        {

        //     Livewire.on("formSubmit", () => {
        //         const form = document.querySelector("#checkoutForm")
        //         // console.log(form);
        //         var options = {
        //             'name': document.getElementById('name').value,
        //             'address_line_1': document.getElementById('address').value,
        //             'address_city': document.getElementById('city').value,
        //             'address_zip': document.getElementById('zip').value,
        //             'address_state': document.getElementById('state').value,
        //         }
        //         payWithPaystack();

        // })

                // stripe.createToken(card, options).then(function(result) {
                //     if (result.error) {
                //         // Inform the user if there was an error.
                //         var errorElement = document.getElementById('card-errors');
                //         $("#card-errors").textContent = result.error.message;
                //         form.querySelectorAll(".input-control").forEach(el => {
                //             el.removeAttribute("readonly")
                //             el.removeAttribute("disabled")
                //         })
                //     } else {
                //         // Send the token to your server.
                //         Livewire.emit("submit", result.token);
                //     }
                // });
            // })






        })



    //     function payWithPaystack() {
	// 	var handler = PaystackPop.setup({
	// 		key: "{{ env('PAYSTACK_PUBLIC_KEY') }}",
	// 		email: $("#email").val(),
	// 		amount: "{{ $total * 100 }}",//This is payment in kobo, so 200 times 100 kobo = #200 ,
	// 		currency: "NGN",
	// 		ref: "{{ str_replace(' ', '_', config('app.name')).'_'.  str_pad(rand(10, 10000000000), 10, '0', STR_PAD_LEFT)}}",//matric_no.replace(/\//g, "_")+ Math.floor(Math.random() * 10),
	// 		firstname: $("#name").val(),// $("[name='firstname']").val(),
	// 		lastname: " ",//$("[name='lastname']").val() ,
	// 		// label: "Optional string that replaces customer email"
	// 		metadata: {
	// 			custom_fields: [
	// 				{
	// 					display_name: "Mobile Number",
	// 					variable_name: "mobile_number",
	// 					value: "08130584550" //$("[name='tel_no']").val()
	// 				},

    //                 {
	// 					display_name: "Address",
	// 					variable_name: "address",
	// 					value: $("#address").val()
	// 				},

    //                 {
	// 					display_name: "City",
	// 					variable_name: "city",
	// 					value: $("#city").val()
	// 				},
    //                 {
	// 					display_name: "State",
	// 					variable_name: "state",
	// 					value: $("#state").val()
	// 				},
    //                 {
	// 					display_name: "Company",
	// 					variable_name: "company",
	// 					value: $("#company").val()
	// 				}
	// 			]
	// 		},
	// 		callback: function (response) {
    //             console.log(response);
	// 		       if (response.reference != '') {

    //                     Livewire.emit("submit", response);

    //                 }
	// 			},

	// 	onClose: function () {
	// 			alert('window closed');
	// 	}
	// 	});
	// 	handler.openIframe();
	// }



        // document.addEventListener("DOMContentLoaded", () => {

            // const stripe = Stripe("{{ env('STRIPE_PUBLISHABLE_KEY') }}");

            // Create an instance of Elements.
            // const elements = stripe.elements();

            // const style = {
            //     base: {
            //         color: '#32325d',
            //         fontFamily: 'Poppins,sans-serif',
            //         fontSmoothing: 'antialiased',
            //         fontSize: '16px',
            //         '::placeholder': {
            //             color: '#888'
            //         }
            //     },
            //     invalid: {
            //         color: '#d43535',
            //         iconColor: '#d43535'
            //     }
            // };

            // Create an instance of the card Element.
            // var card = elements.create('card', {
            //     style: style
            // });

            // Add an instance of the card Element into the `card-element` <div>.
            // card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            // card.on('change', function(event) {
            //     var displayError = document.getElementById('card-errors');
            //     if (event.error) {
            //         displayError.textContent = event.error.message;
            //     } else {
            //         displayError.textContent = "";
            //     }
            // });

        //     Livewire.on("formSubmit", () => {
        //         const form = document.querySelector("#checkoutForm")
        //         // console.log(form);
        //         var options = {
        //             'name': document.getElementById('name').value,
        //             'address_line_1': document.getElementById('address').value,
        //             'address_city': document.getElementById('city').value,
        //             'address_zip': document.getElementById('zip').value,
        //             'address_state': document.getElementById('state').value,
        //         }

        //         var ref = "KOADT_";/// $("#matric_no").val();
        // // alert(matric_no.replace(/\//g, "_"));
		// var handler = PaystackPop.setup({
		// 	key: "{{ env('PAYSTACK_PUBLIC_KEY') }}",
		// 	email: document.getElementById('email').value,
		// 	amount: 1000*100,
		// 	currency: "NGN",
		// 	ref: ref.replace(/\//g, "_")+ Math.floor(Math.random() * 10),
		// 	firstname:document.getElementById('name').value,
		// 	lastname: document.getElementById('company').value ,
		// 	// label: "Optional string that replaces customer email"
		// 	metadata: {
		// 		custom_fields: [
		// 			{
		// 				display_name: "Mobile Number",
		// 				variable_name: "mobile_number",
		// 				value: document.getElementById('mobile').value,
		// 			}
		// 		]
		// 	},
		// 	callback: function (response) {
		// 		$("[name='referrence']").val(response.reference);
        //     }
        // })

        //         // stripe.createToken(card, options).then(function(result) {
        //         //     if (result.error) {
        //         //         // Inform the user if there was an error.
        //         //         var errorElement = document.getElementById('card-errors');
        //         //         $("#card-errors").textContent = result.error.message;
        //         //         form.querySelectorAll(".input-control").forEach(el => {
        //         //             el.removeAttribute("readonly")
        //         //             el.removeAttribute("disabled")
        //         //         })
        //         //     } else {
        //         //         // Send the token to your server.
        //         //         Livewire.emit("submit", result.token);
        //         //     }
        //         // });
        //     })
        // });





    </script>
@endpush
