<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        {{ $style ?? '' }}
    </head>
    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark", "layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false, "darkMode":false, "showRightSidebarOnStart": false}'>
        <div class="wrapper">
            <div class="leftside-menu">
                <a href="{{ route('dashboard') }}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="16">
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" height="16">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar>
                    <ul class="side-nav">
                        <li class="side-nav-title side-nav-item">Navigation</li>
                        @canany('dashboard_view', 'defence_request')
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                    <i class="uil-home-alt"></i>
                                    <span class="badge bg-success float-end">2</span>
                                    <span> Dashboards </span>
                                </a>
                                <div class="collapse" id="sidebarDashboards">
                                    <ul class="side-nav-second-level">
                                        @can('dashboard_view')
                                            <li>
                                                <a href="{{ route('dashboard') }}">Analytics</a>
                                            </li>
                                        @endcan
                                        
                                        @can('defence_request')
                                            <li>
                                                <a href="{{ url('defence-request') }}">Alumni Request</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                        @endcanany

                        <li class="side-nav-title side-nav-item">Apps</li>

                        @canany(['dashboard_view', 'batch_view', 'session_view', 'group_view'])
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#Academy" aria-expanded="false" aria-controls="Academy" class="side-nav-link">
                                    <i class="uil-cell"></i>
                                    <span> Academy </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Academy">
                                    <ul class="side-nav-second-level">
                                        @can('dashboard_view')
                                            <li>
                                                <a href="{{ route('departments.index') }}">Departments</a>
                                            </li>
                                        @endcan
                                        
                                        @can('batch_view')
                                            <li>
                                                <a href="{{ route('batches.index') }}">Batches</a>
                                            </li>
                                        @endcan
                                        
                                        @can('session_view')
                                            <li>
                                                <a href="{{ route('sessions.index') }}">Sessions</a>
                                            </li>
                                        @endcan
                                        
                                        @can('group_view')
                                            <li>
                                                <a href="{{ route('groups.index') }}">Groups</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                        @endcanany

                        @can('student_view')
                            <li class="side-nav-item">
                                <a href="{{ route('students.index') }}" class="side-nav-link">
                                    <i class="uil-graduation-hat"></i>
                                    <span> Students </span>
                                </a>
                            </li>
                        @endcan

                        @can('defence_view')
                            <li class="side-nav-item">
                                <a href="{{ route('defences.index') }}" class="side-nav-link">
                                    <i class="uil-file-check-alt"></i>
                                    <span> Alumnus </span>
                                </a>
                            </li>
                        @endcan

                        @can('teacher_view')
                            <li class="side-nav-item">
                                <a href="{{ route('teachers.index') }}" class="side-nav-link">
                                    <i class="dripicons-user-id"></i>
                                    <span> Teachers </span>
                                </a>
                            </li>
                        @endcan

                        @can('event_view')
                            <li class="side-nav-item">
                                <a href="apps-chat.html" class="side-nav-link">
                                    <i class="uil-shutter-alt"></i>
                                    <span> Events </span>
                                </a>
                            </li>
                        @endcan

                        @can('notice_view')
                            <li class="side-nav-item">
                                <a href="apps-chat.html" class="side-nav-link">
                                    <i class="uil-comment-notes"></i>
                                    <span> Notices </span>
                                </a>
                            </li>
                        @endcan

                        <li class="side-nav-title side-nav-item">System</li>

                        @canany('user_view', 'role_view')
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#UserManagement" aria-expanded="false" aria-controls="UserManagement" class="side-nav-link">
                                    <i class="uil-weight"></i>
                                    <span> User Management </span>
                                    <span class="menu-arrow"></span>
                                </a>

                                <div class="collapse" id="UserManagement">
                                    <ul class="side-nav-second-level">
                                        @can('user_view')
                                            <li>
                                                <a href="{{ route('users.index') }}"> Users </a>
                                            </li>
                                        @endcan

                                        @can('role_view')
                                            <li>
                                                <a href="{{ route('roles.index') }}"> Roles </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                        @endcanany

                        @can('setting_view')
                            <li class="side-nav-item">
                                <a href="{{ url('settings') }}" class="side-nav-link">
                                    <i class="dripicons-gear noti-icon"></i>
                                    <span> Settings </span>
                                </a>
                            </li>
                        @endcan
                    </ul>

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="content-page">
                <div class="content">
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            <li class="dropdown notification-list d-lg-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-search noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-bell noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0">
                                            <span class="float-end">
                                                <a href="javascript: void(0);" class="text-dark">
                                                    <small>Clear All</small>
                                                </a>
                                            </span>Notification
                                        </h5>
                                    </div>

                                    <div style="max-height: 230px;" data-simplebar>
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">Caleb Flakelar commented on Admin
                                                <small class="text-muted">1 min ago</small>
                                            </p>
                                        </a>

                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info">
                                                <i class="mdi mdi-account-plus"></i>
                                            </div>
                                            <p class="notify-details">New user registered.
                                                <small class="text-muted">5 hours ago</small>
                                            </p>
                                        </a>

                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="{{ asset('assets/images/avator.png') }}" class="img-fluid rounded-circle" alt="" /> </div>
                                            <p class="notify-details">Cristina Pride</p>
                                            <p class="text-muted mb-0 user-msg">
                                                <small>Hi, How are you? What about our next meeting</small>
                                            </p>
                                        </a>

                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">Caleb Flakelar commented on Admin
                                                <small class="text-muted">4 days ago</small>
                                            </p>
                                        </a>

                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="{{ asset('assets/images/avator.png') }}" class="img-fluid rounded-circle" alt="" /> </div>
                                            <p class="notify-details">Karen Robinson</p>
                                            <p class="text-muted mb-0 user-msg">
                                                <small>Wow ! this admin looks good and awesome design</small>
                                            </p>
                                        </a>

                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info">
                                                <i class="mdi mdi-heart"></i>
                                            </div>
                                            <p class="notify-details">Carlos Crouch liked
                                                <b>Admin</b>
                                                <small class="text-muted">13 days ago</small>
                                            </p>
                                        </a>
                                    </div>

                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                        View All
                                    </a>

                                </div>
                            </li>

                            <li class="notification-list">
                                <a class="nav-link" href="{{ url('settings') }}">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar">
                                        @if (Auth::user()->image)
                                            <img src="/images/default/{{ Auth::user()->image }}" alt="user-image" class="rounded-circle">
                                        @else
                                            <img src="{{ asset('assets/images/avator.png') }}" alt="user-image" class="rounded-circle">
                                        @endif
                                    </span>
                                    <span>
                                        <span class="account-user-name">{{ Auth::user()->name }}</span>
                                        <span class="account-position">{{ Auth::user()->position ?? '' }}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <a href="{{ route('users.show', Auth::user()->id) }}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>
                                    
                                    <a href="{{ url('system-settings') }}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit me-1"></i>
                                        <span>Settings</span>
                                    </a>

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-lifebuoy me-1"></i>
                                        <span>Support</span>
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item notify-item">
                                            <i class="mdi mdi-logout me-1"></i>
                                            <span>Logout</span>
                                        </a>
                                    </form>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="app-search dropdown d-none d-lg-block">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control dropdown-toggle"  placeholder="Search..." id="top-search">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button class="input-group-text btn-primary" type="submit">Search</button>
                                </div>
                            </form>

                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                <div class="dropdown-header noti-title">
                                    <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                                </div>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-notes font-16 me-1"></i>
                                    <span>Analytics Report</span>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-life-ring font-16 me-1"></i>
                                    <span>How can I help you?</span>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-cog font-16 me-1"></i>
                                    <span>User profile settings</span>
                                </a>

                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                </div>

                                <div class="notification-list">
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex">
                                            <img class="d-flex me-2 rounded-circle" src="{{ asset('assets/images/avator.png') }}" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Erwin Brown</h5>
                                                <span class="font-12 mb-0">UI Designer</span>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex">
                                            <img class="d-flex me-2 rounded-circle" src="{{ asset('assets/images/avator.png') }}" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Jacob Deo</h5>
                                                <span class="font-12 mb-0">Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =============================================================== -->
                    <main>
                        {{ $slot }}
                    </main>
                    <!-- =============================================================== -->
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Falcon - abdullahalshahin.me
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="rightbar-overlay"></div>

        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/sweetalert2@11') }}"></script>
        {{ $script ?? '' }}
    </body>
</html>
