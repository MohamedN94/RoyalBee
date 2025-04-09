<a href="{{route('dashboard.coupons.edit',['coupon'=>$Coupon->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Language">
    <i class="la la-edit"></i>
</a>

<a data-url="{{route('dashboard.coupons.destroy',['coupon'=>$Coupon->id])}}"
   data-item-id="{{ $Coupon->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <i class="la la-trash"></i>
</a>

<script src="{{ asset('assets/js/delete-item.js') }}" type="text/javascript"></script>
