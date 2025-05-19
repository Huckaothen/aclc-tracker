$(document).ready(function () {
    var quill = new Quill('#description', {
        theme: 'snow',
        placeholder: 'Enter forums...',
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
        $('#description_input').val(quill.root.innerHTML);
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

        formData.set('description', eventDescription);

        $.ajax({
            url: "forum/store",
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
            url: "forum/" + id,
            type: "GET",
            success: function (response) {
                if (response.success) {
                    let forum = response.forum;

                    $('#id').val(forum.id);
                    $('#name').val(forum.name);
                  $('#edit-alumni-status').val(forum.status);

                    // Set forum description content inside Quill Editor
                    quill.root.innerHTML = forum.description;



                    // Update Modal Title and Show Modal
                    $("#addEditEventModallLabel").text("Edit Forum");
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
        $("#eventForm").trigger('reset');
        $("#id").val("");
        $("#addEditEventModallLabel").text("Add Forum");
        $("#addEditEventModal").modal('show');
    });

    $(document).on('click', '.btn-close', function () {
        $('#addEditEventModal').modal('hide');
    });

});
