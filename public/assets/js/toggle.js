$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Ensure the event is not bound multiple times
$(document).off('click','.trend-button').on('click', '.trend-button', function(e) {
    e.preventDefault(); // Prevent default anchor behavior

    var button = $(this);
    var url = button.data('url');
    var itemId = button.data('item-id');

    // Disable button to prevent multiple clicks
    button.prop('disabled', true);

    $.ajax({
        url: url,
        type: 'POST', // Assuming you're using a PUT request for toggling
        success: function(response) {
            if (response.status === 'success') {
                // Toggle the icon and text
                var icon = button.find('i.option-icon');
                var text = button.find('.trend-text');
                if (icon.hasClass('fa-plus')) {
                    icon.removeClass('fa-plus').addClass('fa-minus');
                    text.text('Remove from Trending');
                } else {
                    icon.removeClass('fa-minus').addClass('fa-plus');
                    text.text('Add to Trending');
                }

                // Optionally, show a success message
                $('#alert-container').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
            } else {
                // Change to a warning alert
                $('#alert-container').html(`
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
            }
        },
        error: function(xhr, status, error) {
            // Show warning message instead of error
            $('#alert-container').html(`
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    issue : ${xhr.responseText}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `);
        },
        complete: function() {
            // Re-enable the button after the request is complete
            button.prop('disabled', false);
        }
    });
});

$(document).off('click','.seller-button').on('click', '.seller-button', function(e) {
    e.preventDefault(); // Prevent default anchor behavior

    var button = $(this);
    var url = button.data('url');
    var itemId = button.data('item-id');

    // Disable button to prevent multiple clicks
    button.prop('disabled', true);

    $.ajax({
        url: url,
        type: 'POST', // Assuming you're using a PUT request for toggling
        success: function(response) {
            if (response.status === 'success') {
                // Toggle the icon and text
                var icon = button.find('i.option-icon');
                var text = button.find('.seller-text');
                if (icon.hasClass('fa-plus')) {
                    icon.removeClass('fa-plus').addClass('fa-minus');
                    text.text('Remove from Best seller');
                } else {
                    icon.removeClass('fa-minus').addClass('fa-plus');
                    text.text('Add to Best seller');
                }

                // Optionally, show a success message
                $('#alert-container').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
            } else {
                // Change to a warning alert
                $('#alert-container').html(`
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
            }
        },
        error: function(xhr, status, error) {
            // Show warning message instead of error
            $('#alert-container').html(`
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    issue : ${xhr.responseText}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `);
        },
        complete: function() {
            // Re-enable the button after the request is complete
            button.prop('disabled', false);
        }
    });
});
