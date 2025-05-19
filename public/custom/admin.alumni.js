
$(document).ready(function () {

    $('#dataTable').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search',
          sSearch: '',
          lengthMenu: '_MENU_',
        }
      });

      // Select2
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    $(".viewAlumniBtn").click(function() {
        let alumniId = $(this).data("id");

        $.ajax({
            url: "alumni/" + alumniId,
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.message === "success") {
                    let data = response.data;

                    $("#alumni-email").text(data.email);
                    $("#alumni-college-id").text(data.college_id);
                    $("#alumni-profile-name").text(data.fullname);
                    $("#alumni-fullname").text(data.fullname);
                    $("#alumni-contact").text(data.contact);
                    $("#alumni-dob").text(data.dob ?? "N/A");
                    $("#alumni-address").text(data.address ?? "N/A");
                    $("#alumni-gender").text(data.gender);
                    $("#alumni-civil-status").text(data.civil_status);
                    $("#alumni-batch").text(data.batch);
                    $("#alumni-course-profile").text(data.graduated_course);
                    $("#alumni-course").text(data.graduated_course);
                    $("#alumni-employability-status").text(data.employability_status);
                    $("#alumni-company").text(data.company_name ?? "N/A");
                    $("#alumni-status").text(data.status);
                    $("#alumni-email-verified").text(data.email_verified_at ?? "Not Verified");
                    $("#alumni-created").text(data.created_at);
                    $("#alumni-updated").text(data.updated_at);
                    $("#alumni-profile").attr("src", data.profile_picture ?? "default.jpg");

                    // Social media links
                    $("#alumni-fb-link").attr("href", data.facebook_link ?? "#").text(data.facebook_link ? "View Profile" : "N/A");
                    $("#alumni-twitter-link").attr("href", data.twitter_link ?? "#").text(data.twitter_link ? "View Profile" : "N/A");
                    $("#alumni-linkedin-link").attr("href", data.linkedin_link ?? "#").text(data.linkedin_link ? "View Profile" : "N/A");

                    // Show modal
                    $("#alumniModal").modal("show");
                }
            },
            error: function(xhr) {
                alert("Failed to retrieve data. Please try again.");
            }
        });
    });

    $(document).on('click', '#btnCareerAddEdit', function () {
        $("#editAlumniForm").trigger('reset');
        $(".az-img-user").hide();
        $("#addEditAlumniModallLabel").text("Add Alumni Profile");
        $("#editAlumniModal").modal('show');
    });

    $(".editAlumniBtn").click(function() {
        let alumniId = $(this).data("id");

        $.ajax({
            url: "alumni/" + alumniId,
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.message === "success") {
                    let data = response.data;
                    $("#edit-alumni-id").val(data.id);
                    $("#edit-alumni-email").val(data.email);
                    $("#edit-alumni-college-id").val(data.college_id);
                    $("#edit-alumni-fullname").val(data.fullname);
                    $("#edit-alumni-contact").val(data.contact);
                    $("#edit-alumni-dob").val(data.dob);
                    $("#edit-alumni-address").val(data.address);
                    $("#edit-alumni-gender").val(data.gender.toLowerCase());
                    $("#edit-alumni-civil-status").val(data.civil_status.toLowerCase());
                    $("#edit-alumni-batch").val(data.batch);
                    $("#edit-alumni-course").val(data.graduated_course);
                    $("#edit-alumni-employability-status").val(data.employability_status.replace(" ", "_").toLowerCase());
                    $("#edit-alumni-company").val(data.company_name);
                    $("#edit-alumni-email-verified").val(data.email_verified_at);
                    $("#edit-alumni-status").val(data.status.toLowerCase());
                    $("#edit-alumni-profile").attr("src", data.profile_picture ?? "default.jpg");

                    // Show modal
                    $(".az-img-user").show();
                    $("#addEditAlumniModallLabel").text("Edit Alumni Profile");
                    $("#editAlumniModal").modal("show");
                }
            },
            error: function(xhr) {
                alert("Failed to retrieve data. Please try again.");
            }
        });
    });

    $("#editAlumniForm").submit(function (e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        let alumniId = $("#edit-alumni-id").val();

        $.ajax({
            url: "alumni/update/" + alumniId,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#editAlumniForm button[type='submit']").prop("disabled", true).text("Updating...");
            },
            success: function (response) {
                alert("Profile updated successfully!");
                $("#editAlumniModal").modal("hide");
                location.reload();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = "";

                $.each(errors, function (key, value) {
                    errorMessages += value[0] + "\n";
                });

                alert("Update failed:\n" + errorMessages);
                $("#editAlumniForm button[type='submit']").prop("disabled", false).text("Save Changes");
            }
        });
    });

    $(document).on('click', '.btn-close', function(){
        $('#alumniModal').modal('hide');
        $('#editAlumniModal').modal('hide');
    });
});