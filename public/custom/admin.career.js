$(document).ready(function () {
    var quill = new Quill('#job_description', {
        theme: 'snow',
        placeholder: 'Enter job description...',
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
        $('#job_description_input').val(quill.root.innerHTML);
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

    $('#jobForm').submit(function (e) {
        e.preventDefault();


        let formData = new FormData(this);

        let jobDescription = quill.getText().trim().length ? quill.root.innerHTML : '';

        formData.set('job_description', jobDescription);

        $.ajax({
            url: "career/store",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#jobForm button[type="submit"]').prop('disabled', true).text('Submitting...');
            },
            success: function (response) {
                if (response.success) {
                    $('#addEditJobModal').modal('hide');
                    alert(response.message);
                    location.reload();
                } else {
                    alert('Something went wrong. Please try again.');
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
                $('#jobForm button[type="submit"]').prop('disabled', false).text('Submit');
            }
        });
    });

    $(document).on('click', '.viewJobBtn', function () {
        let jobId = $(this).data('id');
    
        $.ajax({
            url: "career/" + jobId + "/show",
            type: "GET",
            success: function (response) {
                if (response.success) {
                    let job = response.job;
    
                    $('#viewCompanyName').text(job.company_name);
                    $('#viewPosition').text(job.position);
                    $('#viewCategory').text(job.category);
                    $('#viewCompanySite').html(job.company_site ? `<a href="${job.company_site}" target="_blank">${job.company_site}</a>` : 'N/A');
                    $('#viewLocation').text(job.location ? job.location : 'N/A');
                    $('#viewOfficeAddress').text(job.office_address ? job.office_address : 'N/A');
                    $('#viewCompanyEstablished').text(job.company_established ? job.company_established : 'N/A');
                    $('#viewCompanySize').text(job.company_size ? job.company_size : 'N/A');
                    $('#viewIsFeatured').text(job.is_featured ? 'Yes' : 'No');
                    $('#viewStartDate').text(job.start_date ? job.start_date.split('T')[0] : 'N/A');
                    $('#viewEndDate').text(job.end_date ? job.end_date.split('T')[0] : 'N/A');
                    $('#viewSalary').text(job.salary ? `₱${parseFloat(job.salary).toLocaleString()}` : 'Not specified');
                    $('#viewExperienceLevel').text(job.experience_level ? job.experience_level : 'N/A');
                    $('#viewQualification').text(job.qualification ? job.qualification : 'N/A');
                    $('#viewStatus').text(job.status);
                    $('#viewJobDescription').html(job.job_description ? job.job_description : 'No description available');
    
                    // Update Google Maps iframe
                    if (job.google_map) {
                        $('#map-container').html(job.google_map).show()
                    } else {
                        $('#map-container').hide(); // Hide map if no location is provided
                    }
    
                    $("#viewJobModal").modal('show');
                } else {
                    alert("Job not found!");
                }
            },
            error: function () {
                alert("Error fetching job details. Please try again.");
            }
        });
    });
     

    $(document).on('click', '.editJobBtn', function () {
        let jobId = $(this).data('id');
    
        $.ajax({
            url: "career/" + jobId + "/show",
            type: "GET",
            success: function (response) {
                if (response.success) {
                    let job = response.job;
    
                    $('#id').val(job.id);
                    $('#category').val(job.category);
                    $('#company_name').val(job.company_name);
                    $('#position').val(job.position);
                    $('#salary').val(job.salary);
                    $('#company_site').val(job.company_site);
                    $('#location').val(job.location);
                    $('#office_address').val(job.office_address);
                    $('#company_established').val(job.company_established);
                    $('#company_size').val(job.company_size);
                    $('#is_featured').val(job.is_featured ? '1' : '0');
                    $('#start_date').val(job.start_date ? job.start_date.split('T')[0] : '');
                    $('#end_date').val(job.end_date ? job.end_date.split('T')[0] : '');
                    $('#google_map').val(job.google_map);
                    $('#experience_level').val(job.experience_level);
                    $('#qualification').val(job.qualification);
                    $('#status').val(job.status);
                    
                    // Set job description content inside Quill Editor
                    quill.root.innerHTML = job.job_description;
    
                    // Update Modal Title and Show Modal
                    $("#addEditJobModallLabel").text("Edit Job");
                    $("#addEditJobModal").modal('show');
                } else {
                    alert("Job not found!");
                }
            },
            error: function () {
                alert("Error fetching job details. Please try again.");
            }
        });
    });    

    $(document).on('change', '.updateStatus', function () {
        let jobId = $(this).data('id');
        let newStatus = $(this).val();

        let loader = `<div class="loader-overlay">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`;
        $("body").append(loader);

        $.ajax({
            url: "career/status",
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), 
                id: jobId,
                status: newStatus
            },
            success: function (response) {
                alert(response.message);
            },
            complete: function () {
                $(".loader-overlay").remove();
            }
        });
    });

    $(document).on('click', '#btnCareerAddEdit', function () {
        $("#id").val("");
        $("#jobForm").trigger('reset');
        $("#addEditJobModallLabel").text("Add Job");
        $("#addEditJobModal").modal('show');
    });

    $(document).on('click', '.btn-close', function () {
        $('#addEditJobModal, #viewJobModal').modal('hide');
    });

});
