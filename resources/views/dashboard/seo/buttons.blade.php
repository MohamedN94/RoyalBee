<a href="{{route('dashboard.SEO.edit',['SEO'=>$seo->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Language">
    <i class="la la-edit"></i>
</a>

{{-- <a data-url="{{route('dashboard.Services.destroy',['Service'=>$service->id])}}"
   data-item-id="{{ $service->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <i class="la la-trash"></i>
</a> --}}

<script src="{{ asset('assets/js/delete-item.js') }}" type="text/javascript"></script>
