$(document).ready(function () {
    var quill = new Quill('#message', {
        theme: 'snow',
        placeholder: 'Enter announcement...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link']
            ]
        }
    });

    quill.on('text-change', function () {
        $('#message_input').val(quill.root.innerHTML);
    });

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
        let eventDescription = quill.getText().trim().length ? quill.root.innerHTML : '';

        formData.set('message', eventDescription);

        $.ajax({
            url: "announcement/store",
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
        let id = $(this).data('id');

        $.ajax({
            url: "announcement/" + id,
            type: "GET",
            success: function (response) {
                if (response.success) {
                    let announcement = response.announcement;

                    $('#id').val(announcement.id);
                    $('#title').val(announcement.title);
                    $('#date_announce').val(announcement.date_announce ? announcement.date_announce.split('T')[0] : '');
                    $('#edit-alumni-status').val(announcement.status);

                    // Set announcement description content inside Quill Editor
                    quill.root.innerHTML = announcement.message;



                    // Update Modal Title and Show Modal
                    $("#addEditEventModallLabel").text("Edit Announcement");
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
        $("#addEditEventModallLabel").text("Add Announcement");
        $("#addEditEventModal").modal('show');
    });

    $(document).on('click', '.btn-close', function () {
        $('#addEditEventModal').modal('hide');
    });

});
