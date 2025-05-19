@extends('layouts.alumni.app')

@section('title', 'ACLC Alumni Tracker | Forums Listing')

@section('content')
<div class="az-content az-content-mail">
  <div class="container">
    <div class="content-wrapper w-100">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex pb-4 mb-4 border-bottom">
                <div class="d-flex align-items-center">
                  <h5 class="page-title mb-n2">Forums</h5>
                  <p class="mt-2 mb-n1 ms-3 text-muted"><strong id="forumCount">0</strong> Forums</p>
                </div>
                <form class="ml-lg-auto d-flex pt-2 pt-md-0 align-items-stretch justify-content-end">
                  <input type="text" class="form-control w-50" id="searchForum" name="searchForum" placeholder="Search">
                  <button type="button" class="btn btn-danger no-wrap ms-4 search-btn" style="height: 20px;">Search</button>
                </form>
              </div>
              <div class="tab-content border-0 tab-content-basic">
                <div class="tab-pane fade show active" id="open-tickets" role="tabpanel" aria-labelledby="open-tickets">
                  <div class="tickets-date-group"></div>
                  <div id="forumsContainer">
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    document.getElementById("searchForum").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); 
        }
    });

    function fetchJobs(page = 1, query = '') {
        $.ajax({
            url: "{{route('alumni.forums.fetch')}}" + "?page=" + page + "&search=" + query,
            method: "GET",
            beforeSend: function () {
                $("#forumsContainer").html("<p>Loading...</p>");
            },
            success: function (data) {
                $("#forumsContainer").html(data.html);
                $("#forumCount").text(data.forumCount);
            }
        });
    }

    // Search Event
    $('.search-btn').on('click', function () {
        let query = $('#searchForum').val();
        fetchJobs(1, query);
    });

    // Pagination Event
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#searchForum').val();
        fetchJobs(page, query);
    });

    fetchJobs();
});

</script>
@endsection