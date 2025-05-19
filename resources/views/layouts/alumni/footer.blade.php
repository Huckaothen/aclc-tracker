<div class="az-footer ht-40">
    <div class="container ht-100p pd-t-0-f">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">© {{ date('Y') }} ACLC Alumni Tracker System. All rights reserved.</span>
    </div>
</div>

<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('ionicons/ionicons.js') }}"></script>

<script src="{{ asset('chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('peity/jquery.peity.min.js') }}"></script>

<script src="{{ asset('azia.js') }}"></script>
<script src="{{ asset('chart.flot.sampledata.js') }}"></script>
<script src="{{ asset('dashboard.sampledata.js') }}"></script>
<script src="{{ asset('jquery.cookie.js') }}"></script>

<script src="{{ asset('datepicker/datepicker.js') }}"></script>
<script src="{{asset('moment/moment.min.js')}}"></script>
<script src="{{asset('fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('select2/select2.full.min.js')}}"></script>
@if(request()->routeIs('alumni.job'))
<script>
  var ALUMNI_JOBS_FETCH_URL = "{{ route('alumni.job.fetch') }}";
</script>
<script src="{{ asset('alumni.jobs.js') }}"></script>
@endif
<script>
  $(function(){
    'use strict'

    $('.select2-modal').select2({
      minimumResultsForSearch: Infinity,
      dropdownCssClass: 'az-select2-dropdown-modal',
    });

    $('#dateToday').text(moment().format('ddd, MMMM DD YYYY'));

  });
</script>
@yield('scripts')