{{-- <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Select an option
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

       <a href="{{ route('dashboard.payments.edit', ['payment' => $payment->id]) }}" class="dropdown-item"
           title="Edit Language">
            <i class="la la-edit"></i>&nbsp; {{ __('dashboard.edit') }}
        </a> 
        <a data-url="{{ route('dashboard.payments.destroy', ['payment' => $payment->id]) }}" style="cursor: pointer;"
           data-item-id="{{ $payment->id }}" class="dropdown-item delete-button" data-toggle="modal"
           data-target="#delete_modal">
            <i class="la la-trash"></i>&nbsp; Delete
        </a>
    </div>
</div> --}}

<a href="{{ route('dashboard.payments.details', ['payment' => $payment->id]) }}"
   class=" dropdown-item" title="View">
    <i class="la la-eye"></i>&nbsp; View
</a>

<a data-url="{{ route('dashboard.payments.destroy', ['payment' => $payment->id]) }}" style="cursor: pointer;"
    data-item-id="{{ $payment->id }}" class="dropdown-item delete-button" data-toggle="modal"
    data-target="#delete_modal">
     <i class="la la-trash"></i>&nbsp; Delete
 </a>

{{-- <a data-url="{{ route('dashboard.payments.destroy', ['payment' => $payment->id]) }}" style="cursor: pointer;"
    data-item-id="{{ $payment->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button" data-toggle="modal"
    data-target="#delete_modal">
     <i class="la la-trash"></i>
 </a> --}}

<script src="{{ asset('assets/js/delete-item.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/toggle.js') }}" type="text/javascript"></script>
