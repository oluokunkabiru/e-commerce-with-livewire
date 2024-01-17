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


@livewire('child.country-properties')


   
    
@endsection
