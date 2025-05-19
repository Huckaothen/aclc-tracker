<div class="az-sidebar">
  <div class="az-sidebar-header">
    <a href="{{ route('admin.home') }}" class="ACLC-logo">
      <img src="{{ asset('assets/images/logo-web.webp') }}" width="55" alt="ACLC Alumni Tracker">
    </a>
  </div>
  <div class="az-sidebar-body">
    <ul class="nav">
      <!-- Dashboard -->
      <li style="padding:8px;" class="nav-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
        <a href="{{ route('admin.home') }}" class="nav-link">
          <i class="typcn typcn-home"></i> Dashboard
        </a>
      </li>

      <!-- Alumni Management -->
      <li style="padding:8px;" class="nav-item {{ request()->routeIs('admin.alumni') ? 'active' : '' }}">
        <a href="{{ route('admin.alumni') }}" class="nav-link">
          <i class="typcn typcn-user"></i> Alumni Management
        </a>
      </li>

      <!-- Career & Jobs -->
      <li style="padding:8px;" class="nav-item {{ request()->routeIs('admin.career') ? 'active' : '' }}">
        <a href="{{ route('admin.career') }}" class="nav-link">
          <i class="typcn typcn-briefcase"></i> Job Opportunities
        </a>
      </li>

      <!-- Events -->
      <li style="padding:8px;" class="nav-item {{ request()->routeIs('admin.event') ? 'active' : '' }}">
        <a href="{{ route('admin.event') }}" class="nav-link">
          <i class="typcn typcn-calendar-outline"></i> Events & Activities
        </a>
      </li>

         <!-- Announcements -->
      <li style="padding:8px;" class="nav-item {{ request()->routeIs('admin.announcement') ? 'active' : '' }}">
        <a href="{{ route('admin.announcement') }}" class="nav-link">
          <i class="typcn typcn-bell"></i> Announcements
        </a>
      </li>

      <!-- Forums -->
      <li style="padding:8px;" class="nav-item {{ request()->routeIs('admin.forum') ? 'active' : '' }}">
        <a href="{{ route('admin.forum') }}" class="nav-link">
          <i class="typcn typcn-message"></i> Forum Management 
        </a>
      </li>

      <!-- Users -->
      <li style="padding:8px;" class="nav-item {{ request()->routeIs('admin.user') ? 'active' : '' }}">
        <a href="{{ route('admin.user') }}" class="nav-link">
          <i class="typcn typcn-group"></i> User Management
        </a>
      </li>


      <!-- Reports & Analytics -->
      {{-- <li style="padding:8px;" class="nav-item">
        <a href="" class="nav-link">
          <i class="typcn typcn-chart-bar"></i> Reports & Analytics
        </a>
      </li> --}}

      <!-- System Settings -->
      {{-- <li style="padding:8px;" class="nav-item">
        <a href="" class="nav-link">
          <i class="typcn typcn-cog-outline"></i> System Settings
        </a>
      </li> --}}

      <!-- Utilities -->
      {{-- <li style="padding:8px;" class="nav-item">
        <a href="#" class="nav-link with-sub">
          <i class="typcn typcn-folder"></i> Utilities
        </a>
        <ul class="nav-sub">
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-image"></i> &nbsp; Gallery</a></li>
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-bell"></i> &nbsp; Announcements</a></li>
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-messages"></i> &nbsp; E-Forums</a></li>
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-gift"></i> &nbsp; Donations</a></li>
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-mortar-board"></i> &nbsp; Training Programs</a></li>
        </ul>
      </li> --}}

      <!-- System Logs -->
      {{-- <li style="padding:8px;" class="nav-item">
        <a href="#" class="nav-link with-sub">
          <i class="typcn typcn-time"></i> System Logs
        </a>
        <ul class="nav-sub">
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-clipboard"></i> &nbsp; Activity Logs</a></li>
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-cloud-storage"></i> &nbsp; System Logs</a></li>
        </ul>
      </li> --}}

      <!-- Support -->
      {{-- <li style="padding:8px;" class="nav-item">
        <a href="#" class="nav-link with-sub">
          <i class="typcn typcn-support"></i> Support & Helpdesk
        </a>
        <ul class="nav-sub">
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-user"></i> &nbsp; Contact Support</a></li>
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-help-outline"></i> &nbsp; FAQs</a></li>
          <li class="nav-sub-item"><a href="" class="nav-sub-link"><i class="typcn typcn-ticket"></i> &nbsp; Submit a Ticket</a></li>
        </ul>
      </li> --}}
    </ul>
  </div>
</div>
