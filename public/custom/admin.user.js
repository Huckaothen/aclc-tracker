$(document).ready(function () {

    $('#dataTable').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Search',
            sSearch: '',
            lengthMenu: '_MENU_',
        }
    });

    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    $('#eventForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "user/store",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#eventForm button[type="submit"]').prop('disabled', true).text('Submitting...');
            },
            success: function (response) {
                if (response.status == 'success') {
                    $('#addEditEventModal').modal('hide');
                    alert(response.message);
                    location.reload();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = "Please fix the following errors:\n\n";

                    $.each(errors, function (field, messages) {
                        errorMessage += "- " + messages.join("\n") + "\n";
                    });

                    alert(errorMessage);
                } else {
                    alert('An unexpected error occurred. Please try again.');
                }
            },
            complete: function () {
                $('#eventForm button[type="submit"]').prop('disabled', false).text('Submit');
            }
        });
    });


    $(document).on('click', '.editEventBtn', function () {
        let user_id = $(this).data('id');
    
        $.ajax({
            url: "user/" + user_id,
            type: "GET",
            success: function (response) {
                if (response.success) {
                    let event = response.event;
    
                    $('#id').val(event.id);
                    $('#event_name').val(event.event_name);
                    $('#start_date').val(event.start_date ? event.start_date.split('T')[0] : '');
                    $('#end_date').val(event.end_date ? event.end_date.split('T')[0] : '');
                    $('#backgroundColor').val(event.backgroundColor);
                    $('#borderColor').val(event.borderColor);
                    $('#edit-alumni-status').val(event.status);
                 
    
                    // Update Modal Title and Show Modal
                    $("#addEditEventModallLabel").text("Edit Event");
                    $("#addEditEventModal").modal('show');
                } else {
                    alert("Event not found!");
                }
            },
            error: function () {
                alert("Error fetching event details. Please try again.");
            }
        });
    });    

    $(document).on('click', '#btnEventAddEdit', function () {
        $("#id").val("");
        $("#eventForm").trigger('reset');
        $("#addEditEventModallLabel").text("Add User");
        $("#addEditEventModal").modal('show');
    });

    $(document).on('click', '.btn-close', function () {
        $('#addEditEventModal').modal('hide');
    });

});
