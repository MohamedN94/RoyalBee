<!--begin::Modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('dashboard.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>{{__('dashboard.deleteAction')}} {{ isset($action_message) ? $action_message : __('dashboard.this_item') }}
                   </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{__('dashboard.close')}}</button>
                <button type="button" class="btn btn-danger" id="delete-button">{{__('dashboard.delete')}}</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
