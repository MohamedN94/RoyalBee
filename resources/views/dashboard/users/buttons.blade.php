@can('update_user')
<a href="{{route('dashboard.users.edit',['user'=>$user->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Language">
    <i class="la la-edit"></i>
</a>
@endcan
@can('delete_user')
<a data-url="{{route('dashboard.users.destroy',['user'=>$user->id])}}"
   data-item-id="{{ $user->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <i class="la la-trash"></i>
</a>
@endcan

<script src="{{ asset('assets/js/delete-item.js') }}" type="text/javascript"></script>
