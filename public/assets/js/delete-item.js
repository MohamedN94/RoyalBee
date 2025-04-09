// Add CSRF token as header for every AJAX request.
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Delete item.
var delete_route;
var item_id;

$('.delete-button').on('click', function () {
    delete_route = $(this).data('url');
    item_id = $(this).data('item-id');
});

// Unbind any existing click event to prevent multiple bindings
$(document).off('click', '#delete-button').on('click', '#delete-button', function () {
    $.ajax({
        url: delete_route,
        type: 'POST',
        data: { _method: 'DELETE' },
        success: function(response) {
            if (response.status === 'success') {
                $('#delete_modal').modal('toggle');
                $('#row-' + item_id).fadeOut();
                $('.dataTable').DataTable().ajax.reload();
                $('#alert-container').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
            } else {
                alert('Error: ' + response.message); // Handle error messages
            }
        },
        error: function(xhr, status, error) {
            alert('An error occurred: ' + xhr.responseText);
        }
    });
});
