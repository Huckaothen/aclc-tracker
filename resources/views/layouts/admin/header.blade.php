<div class="az-header">
    <div class="container-fluid">
      <div class="az-header-left">
        <a href="" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
        &nbsp; <strong>ACLC - Alumni Tracker System</strong>
      </div>
      <div class="az-header-right">
        {{-- <div class="dropdown az-header-notification">
          <a href="" class="new"><i class="typcn typcn-bell"></i></a>
          <div class="dropdown-menu">
            <div class="az-dropdown-header mg-b-20 d-sm-none">
              <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
            </div>
            <h6 class="az-notification-title">Notifications</h6>
            <p class="az-notification-text">You have 2 unread notification</p>
            <div class="az-notification-list">
              <div class="media new">
                <div class="az-img-user">
                  <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile">
                </div>
                <div class="media-body">
                  <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                  <span>Mar 15 12:32pm</span>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- az-notification-list -->
            <div class="dropdown-footer"><a href="">View All Notifications</a></div>
          </div><!-- dropdown-menu -->
        </div><!-- az-header-notification --> --}}
        <div class="dropdown az-profile-menu">
          <a href="" class="az-img-user">
            <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile">
          </a>
          <div class="dropdown-menu">
            <div class="az-dropdown-header d-sm-none">
              <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
            </div>
            <div class="az-header-profile">
              <div class="az-img-user">
                <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile">
              </div><!-- az-img-user -->
              <h6>{{auth()->user()->name}}</h6>
              <span>{{auth()->user()->email}}</span>
            </div><!-- az-header-profile -->

            {{-- <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a> --}}
            {{-- <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a> --}}
            {{-- <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a> --}}
            {{-- <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a> --}}
            <a href="{{route('admin.logout')}}" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
          </div><!-- dropdown-menu -->
        </div>
      </div><!-- az-header-right -->
    </div><!-- container -->
  </div><!-- az-header -->