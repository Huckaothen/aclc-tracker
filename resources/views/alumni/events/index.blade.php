@extends('layouts.alumni.app')

@section('title', 'ACLC Alumni Tracker | Event Listing')

@section('content')
<div class="az-content az-content-calendar">
    <div class="container">
      <div class="az-content-left az-content-left-calendar">
        <div class="az-content-header">
          <a href="" id="azMenuShow" class="az-header-menu-icon"><span></span></a>
          <a href="index.html" class="az-logo">az<span>i</span>a</a>
          <a href="" id="azContentLeftHide" class="az-header-arrow">
            <i class="icon ion-md-arrow-forward d-sm-none"></i>
            <i class="icon ion-md-close d-none d-sm-block"></i>
          </a>
        </div><!-- az-content-header -->

        <div id="dateToday" class="az-content-label az-content-label-sm tx-medium lh-1 mg-b-10"></div>
        <h2 class="az-content-title mg-b-25 tx-24">My Calendar</h2>

        <div class="fc-datepicker az-datepicker mg-b-30"></div>

        <label class="az-content-label tx-13 tx-bold mg-b-10">Event List</label>
        <nav class="nav az-nav-column az-nav-calendar-event" id="event-list">
            <!-- Event list will be populated here -->
        </nav>
      </div>
      <div class="az-content-body az-content-body-calendar">

        <div id="calendar" class="az-calendar"></div>
      </div><!-- az-content-body -->
    </div><!-- container -->
  </div><!-- az-content -->
  <div class="modal az-modal-calendar-event" id="modalCalendarEvent" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="event-title"></h6>
          <nav class="nav nav-modal-event">
            {{-- <a href="#" class="nav-link"><i class="icon ion-md-open"></i></a>
            <a href="#" class="nav-link"><i class="icon ion-md-trash"></i></a> --}}
            <a href="#" class="nav-link" data-bs-dismiss="modal" id="modal_hide_event"><i class="icon ion-md-close"></i></a>
          </nav>
        </div><!-- modal-header -->
        <div class="modal-body">
          <div class="row row-sm">
            <div class="col-sm-6">
              <label class="tx-13 tx-gray-600 mg-b-2">Start Date</label>
              <p class="event-start-date"></p>
            </div>
            <div class="col-sm-6">
              <label class="tx-13 mg-b-2">End Date</label>
              <p class="event-end-date"></p>
            </div><!-- col-6 -->
          </div><!-- row -->

          <label class="tx-13 tx-gray-600 mg-b-2">Description</label>
          <p class="event-desc tx-gray-900 mg-b-30"></p>

          {{-- <a href="javascript:void(0);" id="modal_hide_event" class="btn btn-secondary wd-80" data-bs-dismiss="modal">Close</a> --}}
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->
@endsection
@section('scripts')
<script>
  $(function(){
  'use strict'

  $('#dateToday').text(moment().format('ddd, MMMM DD YYYY'));

  function populateEventList(response) {
    $('#event-list').empty();
    if(response.length > 0) {
        response.forEach(function(event) {
          let eventBackgroundColor = event.backgroundColor || '#000000';

          $('#event-list').append(`
              <a href="/event/${event.id}" class="nav-link" >
                  <i class="icon ion-ios-calendar" style="color: ${eventBackgroundColor};"></i>
                  <div>${event.title}</div>
              </a>
          `);
      });
    } else {
      $('#event-list').append(`<div>No events to display</div>`);
    }
  }

  var azCalendarEvents = {
    url: "{{route('alumni.event.get')}}",
    type: 'GET',
    success: function(events) {
      console.log("events!!!", events)
      // This callback only works if you define events as a function (see below)
      populateEventList(events);
    },
    error: function() {
      console.log('Error fetching events');
    }
  };


  var highlightedDays = ['2025-5-10','2025-5-11','2025-5-12','2025-5-13','2025-5-14','2025-5-15','2025-5-16'];
  var date = new Date();

  $('.fc-datepicker').datepicker({
    showOtherMonths: true,
    selectOtherMonths: true,
    dateFormat: 'yy-mm-dd',
    beforeShowDay: function(date) {
      var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
      for (var i = 0; i < highlightedDays.length; i++) {
        if($.inArray(y + '-' + (m+1) + '-' + d,highlightedDays) != -1) {
          return [true, 'ui-date-highlighted', ''];
        }
      }
      return [true];
    }
  });

  var generateTime = function(element) {
    var n = 0,
    min = 30,
    periods = [' AM', ' PM'],
    times = [],
    hours = [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

    for (var i = 0; i < hours.length; i++) {
      times.push(hours[i] + ':' + n + n + periods[0]);
      while (n < 60 - min) {
        times.push(hours[i] + ':' + ((n += min) < 10 ? 'O' + n : n) + periods[0])
      }
      n = 0;
    }

    times = times.concat(times.slice(0).map(function(time) {
      return time.replace(periods[0], periods[1])
    }));

    //console.log(times);
    $.each(times, function(index, val){
      $(element).append('<option value="'+val+'">'+val+'</option>');
    });
  }

  generateTime('.az-event-time');

  // Initialize fullCalendar
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listWeek'
    },
    navLinks: true,
    selectable: true,
    selectLongPressDelay: 100,
    editable: true,
    nowIndicator: true,
    defaultView: 'listMonth',
    views: {
      agenda: {
        columnHeaderHtml: function(mom) {
          return '<span>' + mom.format('ddd') + '</span>' +
                 '<span>' + mom.format('DD') + '</span>';
        }
      },
      day: { columnHeader: false },
      listMonth: {
        listDayFormat: 'ddd DD',
        listDayAltFormat: false
      },
      listWeek: {
        listDayFormat: 'ddd DD',
        listDayAltFormat: false
      },
      agendaThreeDay: {
        type: 'agenda',
        duration: { days: 3 },
        titleFormat: 'MMMM YYYY'
      }
    },
    eventSources: [azCalendarEvents],
    eventAfterAllRender: function(view) {
      if(view.name === 'listMonth' || view.name === 'listWeek') {
        var dates = view.el.find('.fc-list-heading-main');
        dates.each(function(){
          var text = $(this).text().split(' ');
          var now = moment().format('DD');

          $(this).html(text[0]+'<span>'+text[1]+'</span>');
          if(now === text[1]) { $(this).addClass('now'); }
        });
      }

      console.log(view.el);
    },
    eventRender: function(event, element) {

      if(event.description) {
        element.find('.fc-list-item-title').append('<span class="fc-desc">' + event.description + '</span>');
        element.find('.fc-content').append('<span class="fc-desc">' + event.description + '</span>');
      }

      var eBorderColor = (event.source.borderColor)? event.source.borderColor : event.borderColor;
      element.find('.fc-list-item-time').css({
        color: eBorderColor,
        borderColor: eBorderColor
      });

      element.find('.fc-list-item-title').css({
        borderColor: eBorderColor
      });

      element.css('borderLeftColor', eBorderColor);
    },
  });

  var azCalendar = $('#calendar').fullCalendar('getCalendar');

  // change view to week when in tablet
  if(window.matchMedia('(min-width: 576px)').matches) {
    azCalendar.changeView('agendaWeek');
  }

  // change view to month when in desktop
  if(window.matchMedia('(min-width: 992px)').matches) {
    azCalendar.changeView('month');
  }

  // change view based in viewport width when resize is detected
  azCalendar.option('windowResize', function(view) {
    if(view.name === 'listWeek') {
      if(window.matchMedia('(min-width: 992px)').matches) {
        azCalendar.changeView('month');
      } else {
        azCalendar.changeView('listWeek');
      }
    }
  });

  // display current date
  var azDateNow = azCalendar.getDate();
  azCalendar.option('select', function(startDate, endDate){
    // $('#modalSetSchedule').modal('show');
    $('#azEventStartDate').val(startDate.format('LL'));
    $('#azEventEndDate').val(endDate.format('LL'));

    $('#azEventStartTime').val(startDate.format('LT')).trigger('change');
    $('#azEventEndTime').val(endDate.format('LT')).trigger('change');
  });

  $(document).on('click', '#modal_hide_event', function() {
    $('#modalCalendarEvent').modal('hide')
  });
  // Display calendar event modal
  azCalendar.on('eventClick', function(calEvent, jsEvent, view){

    var modal = $('#modalCalendarEvent');

    modal.modal('show');
    modal.find('.event-title').text(calEvent.title);

    if(calEvent.description) {
      modal.find('.event-desc').html(calEvent.description);
      modal.find('.event-desc').prev().removeClass('d-none');
    } else {
      modal.find('.event-desc').text('');
      modal.find('.event-desc').prev().addClass('d-none');
    }

    modal.find('.event-start-date').text(moment(calEvent.start).format('LLL'));
    modal.find('.event-end-date').text(moment(calEvent.end).format('LLL'));
    //styling
    console.log("color:", (calEvent.source.borderColor)? calEvent.source.borderColor : calEvent.borderColor)
    modal.find('.modal-header').css('backgroundColor', (calEvent.source.borderColor)? calEvent.source.borderColor : calEvent.borderColor);
  });

  // Enable/disable calendar events from displaying in calendar
  $('.az-nav-calendar-event a').on('click', function(e){
      e.preventDefault();
      if($(this).hasClass('exclude')) {
        $(this).removeClass('exclude');

        $(this).is(':first-child')? azCalendar.addEventSource(azCalendarEvents) : '';

      } else {
        $(this).addClass('exclude');

        $(this).is(':first-child')? azCalendar.removeEventSource(1) : '';
      }

      azCalendar.render();

      if(window.matchMedia('(max-width: 575px)').matches) {
        $('body').removeClass('az-content-left-show');
      }
  });

});

</script>
@endsection
