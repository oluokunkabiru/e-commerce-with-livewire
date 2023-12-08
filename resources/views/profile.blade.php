@extends('layouts.app')

@section('title')
    Profile
@endsection
@section('extra-css')

<style>
 .become-agent-button {
  background-color: #1446a0;
  color: #fff;
  font-family: Roboto, sans-serif;
  font-weight: bold;
  font-size: 16px;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  /* cursor: pointer; */
  animation: pulsate 2s infinite ease-in-out;
}

@keyframes pulsate {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}


</style>
    
@endsection
@section('contents')

    <div>
        <div class="bradcaump py-4">
            <div class="container">
                <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-home mr-2" aria-hidden="true"></i>Properties</a>
                <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                        aria-hidden="true"></i></button>
                <button class="btn btn-lg btn-transparent p-3 shadow-0">
                    Profile</button>
            </div>
        </div>
        <div class="container py-4 mt-4">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h4 class="bg-light p-4 text-center text-uppercase mb-4 shadow-5 rounded">User information</h4>
                    <button type="button" data-mdb-toggle="modal" data-mdb-target="#becomeAgent"  class="become-agent-button">Become an Agent Now</button>


                    @livewire('child.update-profile')

                </div>
                <div class="col-md-6 col-sm-12">
                    <h4 class="bg-light p-4 text-center text-uppercase mb-4 shadow-5 rounded">Change password</h4>

                    @livewire('child.change-password')

                </div>


                {{-- <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8">
                  <button data-mdb-toggle="modal" data-mdb-target="#fundMyAccount"
                      class="btn-danger mdc-button mdc-button--raised icon-button mx-2 p-3 rounded-3 ">
                      <i class="fas fa-wallet "></i> Fund Account
                  </button>



                  <button class="mdc-button mdc-button--raised icon-button filled-button--info mx-2 p-3 rounded-3">
                      <i class="fa-solid fa-wallet"></i> Invest
                  </button>




              </div> --}}
                @livewire('become-agent')

            </div>

            <!-- Buttons trigger collapse  bs-modal-->




<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">...</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-mdb-ripple-init>Save changes</button>
      </div>
    </div>
  </div>
</div>

  
  <!-- Modal -->
  <div
    class="modal fade"
    id="becomeAgent"
    data-mdb-backdrop="static"
    data-mdb-keyboard="false"
    tabindex="-1"
    aria-labelledby="becomeAgentLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="becomeAgentLabel">Modal title</h5>
          <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">...</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-mdb-ripple-init>Understood</button>
        </div>
      </div>
    </div>
  </div> --}}
            
        </div>
    </div>

@endsection
