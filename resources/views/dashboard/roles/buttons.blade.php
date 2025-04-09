@can('update_role')
    <a href="{{route('dashboard.roles.edit',['role'=>$role->id])}}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Language">
        <i class="la la-edit"></i>
    </a>
@endcan
@can('delete_role')
    <a data-url="{{route('dashboard.roles.destroy',['role'=>$role->id])}}"
       data-item-id="{{ $role->id }}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
       data-toggle="modal"
       data-target="#delete_modal">
        <i class="la la-trash"></i>
    </a>
@endcan

<script src="{{ asset('assets/js/delete-item.js') }}" type="text/javascript"></script>
