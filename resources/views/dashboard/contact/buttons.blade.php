<a href="{{route('dashboard.contact.message',['id'=>$Contact->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="view">
    <i class="la la-file-text"></i>
</a>

{{-- <a data-url="{{route('dashboard.Services.destroy',['Service'=>$service->id])}}"
   data-item-id="{{ $service->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <i class="la la-trash"></i>
</a> --}}

<script src="{{ asset('assets/js/delete-item.js') }}" type="text/javascript"></script>
