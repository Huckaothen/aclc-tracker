$(document).ready(function () {
  document.getElementById("searchJob").addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
    }
  });

  function fetchJobs(page = 1, query = '') {
    $.ajax({
      url: ALUMNI_JOBS_FETCH_URL + "?page=" + page + "&search=" + query,
      method: "GET",
      beforeSend: function () {
        $("#jobsContainer").html("<p>Loading...</p>");
      },
      success: function (data) {
        $("#jobsContainer").html(data.html);

        // ✅ Update Job Count
        $("#jobCount").text(data.jobCount);
      }
    });
  }

  // Search Event
  $('.search-btn').on('click', function () {
    let query = $('#searchJob').val();
    fetchJobs(1, query);
  });

  // Pagination Event
  $(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    let page = $(this).attr('href').split('page=')[1];
    let query = $('#searchJob').val();
    fetchJobs(page, query);
  });

  fetchJobs();
});
