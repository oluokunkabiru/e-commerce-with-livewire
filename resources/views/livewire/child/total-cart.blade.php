
@if (totalCart() > 0)
<a href="{{ route('cart') }}"  style="float:right"  class="btn btn-white btn-floating ">
    <i class="fa fa-building"></i>
    <span class="cart-badge badge rounded-pill badge-notification bg__primary"
        >{{ totalCart() }}</span>
</a>
@endif
