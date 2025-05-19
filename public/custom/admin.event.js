$(document).ready(function () {
    var quill = new Quill('#event_description', {
        theme: 'snow',
        placeholder: 'Enter event description...',
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
        $('#event_description_input').val(quill.root.innerHTML);
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
            url: "event/store",
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
        let event_id = $(this).data('id');
    
        $.ajax({
            url: "event/" + event_id,
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
                    
                    // Set event description content inside Quill Editor
                    quill.root.innerHTML = event.description;

                    $("#backgroundColor").spectrum({
                        color: event.backgroundColor,
                        preferredFormat: "hex",
                        showInput: true,
                        showPalette: true,
                        palette: [
                            ['#f00', '#0f0', '#00f', '#ff0', '#0ff', '#f0f', '#000', '#fff', '#00cccc']
                        ],
                        change: function (color) {
                            $("#backgroundColor").val(color.toHexString());
                        }
                    });

                    $("#borderColor").spectrum({
                        color: event.borderColor,
                        preferredFormat: "hex",
                        showInput: true,
                        showPalette: true,
                        palette: [
                            ['#f00', '#0f0', '#00f', '#ff0', '#0ff', '#f0f', '#000', '#fff', '#00cccc']
                        ],
                        change: function (color) {
                            $("#borderColor").val(color.toHexString());
                        }
                    });
                
    
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
        $("#backgroundColor").spectrum({
            color: "#000000",
            preferredFormat: "hex",
            showInput: true,
            showPalette: true,
            palette: [
                ['#f00', '#0f0', '#00f', '#ff0', '#0ff', '#f0f', '#000', '#fff', '#00cccc']
            ],
            change: function (color) {
                $("#backgroundColor").val(color.toHexString());
            }
        });
    
        $("#backgroundColor").on("input", function () {
            let color = $(this).val();
            if (/^#([0-9A-F]{3}){1,2}$/i.test(color)) {
                $("#backgroundColor").spectrum("set", color);
            }
        });
    
        $("#borderColor").spectrum({
            color: "#ffffff",
            preferredFormat: "hex",
            showInput: true,
            showPalette: true,
            palette: [
                ['#f00', '#0f0', '#00f', '#ff0', '#0ff', '#f0f', '#000', '#fff', '#00cccc']
            ],
            change: function (color) {
                $("#borderColor").val(color.toHexString());
            }
        });
    
        $("#borderColor").on("input", function () {
            let color = $(this).val();
            if (/^#([0-9A-F]{3}){1,2}$/i.test(color)) {
                $("#borderColor").spectrum("set", color);
            }
        });

        $("#addEditEventModallLabel").text("Add Event");
        $("#addEditEventModal").modal('show');
    });

    $(document).on('click', '.btn-close', function () {
        $('#addEditEventModal').modal('hide');
    });

});
