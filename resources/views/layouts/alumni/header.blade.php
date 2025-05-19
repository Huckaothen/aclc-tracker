<div class="az-header">
  <div class="container">
      <div class="az-header-left">
          <a href="#" class="ACLC-logo">
              <img src="{{ asset('assets/images/logo-web.webp') }}" width="55" alt="ACLC Alumni Tracker">
          </a>
          <a href="#" id="azMenuShow" class="az-header-menu-icon d-lg-none"><i class="fas fa-bars"></i></a>
      </div><!-- az-header-left -->

      <div class="az-header-menu">
          <div class="az-header-menu-header">
              <a href="#" class="ACLC-logo">ACLC Alumni</a>
              <a href="#" class="close">&times;</a>
          </div><!-- az-header-menu-header -->

          <ul class="nav">
              <li class="nav-item {{ request()->routeIs('alumni.home') ? 'active' : '' }}">
                  <a href="{{ route('alumni.home') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a>
              </li>
              <li class="nav-item {{ request()->routeIs('alumni.job') ? 'active' : '' }}">
                  <a href="{{ route('alumni.job') }}" class="nav-link"><i class="fas fa-briefcase"></i> &nbsp;Posted Jobs</a>
              </li>
              <li class="nav-item {{ request()->routeIs('alumni.event') ? 'active' : '' }}">
                  <a href="{{route('alumni.event')}}" class="nav-link"><i class="fas fa-calendar-alt"></i> &nbsp;Events</a>
              </li>
              {{-- <li class="nav-item">
                  <a href="#" class="nav-link with-sub"><i class="fas fa-folder"></i> &nbsp;Modules</a>
                  <nav class="az-menu-sub">
                    <a href="#" class="nav-link"><i class="fas fa-bullhorn"></i> Search Alumni</a>
                      <a href="#" class="nav-link"><i class="fas fa-bullhorn"></i> Announcements</a>
                      <a href="#" class="nav-link"><i class="fas fa-comments"></i> E-Forums</a>
                      <a href="#" class="nav-link"><i class="fas fa-hand-holding-usd"></i> Donations</a>
                      <a href="#" class="nav-link"><i class="fas fa-chalkboard-teacher"></i> Training Program</a>
                      <a href="#" class="nav-link"><i class="fas fa-images"></i> Gallery</a>
                  </nav>
              </li> --}}
              <li class="nav-item {{ request()->routeIs('alumni.batch') ? 'active' : '' }}">
                  <a href="{{route('alumni.batch')}}" class="nav-link"><i class="fas fa-users"></i> &nbsp;Alumni</a>
              </li>
              <li class="nav-item {{ request()->routeIs('alumni.announcement') ? 'active' : '' }}">
                  <a href="{{route('alumni.announcement')}}" class="nav-link"><i class="fas fa-bullhorn"></i> &nbsp;Announcement</a>
              </li>
              <li class="nav-item {{ request()->routeIs('alumni.forums') || request()->routeIs('alumni.forums.show') ? 'active' : '' }}">
                <a href="{{route('alumni.forums')}}" class="nav-link"><i class="fas fa-comments"></i> &nbsp;Forums</a>
            </li>
          </ul>
      </div><!-- az-header-menu -->

      <div class="az-header-right">
          {{-- <div class="dropdown az-header-notification">
              <a href="#" class="new"><i class="fas fa-bell"></i></a>
              <div class="dropdown-menu">
                  <h6 class="az-notification-title">Notifications</h6>
                  <p class="az-notification-text">You have 2 unread notifications</p>
                  <div class="az-notification-list">
                      <div class="media new">
                          <div class="az-img-user">
                                <img src="{{ auth()->guard('alumni')->user()->profile_picture 
                                        ? asset('storage/' . auth()->guard('alumni')->user()->profile_picture) 
                                        : asset('storage/profile_pictures/default.png') }}" 
                                alt="Alumni Profile">
                            </div>
                            <div class="media-body">
                                <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                                <span>Mar 15, 12:32 PM</span>
                            </div>
                        </div>
                  </div>
                  <div class="dropdown-footer"><a href="#">View All Notifications</a></div>
              </div>
          </div><!-- az-header-notification --> --}}

          <div class="dropdown az-profile-menu">
              <a href="#" class="az-img-user">
                <img src="{{ auth()->guard('alumni')->user()->profile_picture 
                        ? asset('storage/' . auth()->guard('alumni')->user()->profile_picture) 
                        : asset('storage/profile_pictures/default.png') }}" 
                alt="Alumni Profile">
              </a>
              <div class="dropdown-menu">
                  <div class="az-header-profile">
                      <div class="az-img-user">
                            <img src="{{ auth()->guard('alumni')->user()->profile_picture 
                                    ? asset('storage/' . auth()->guard('alumni')->user()->profile_picture) 
                                    : asset('storage/profile_pictures/default.png') }}" 
                            alt="Alumni Profile">
                        </div>
                      <h6>{{ ucwords(auth()->guard('alumni')->user()->fullname)}}</h6>
                      <span>Batch {{ auth()->guard('alumni')->user()->batch}}</span>
                  </div>
                  <a href="{{route('alumni.profile')}}" class="dropdown-item"><i class="fas fa-user"></i> My Profile</a>
                  <a href="{{route('alumni.logout')}}" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
              </div><!-- dropdown-menu -->
          </div><!-- az-profile-menu -->
      </div><!-- az-header-right -->
  </div><!-- container -->
</div><!-- az-header -->
