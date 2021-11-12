<nav class="sidebar sidebar-offcanvas" id="sidebar">
   <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
         <a class="nav-link" href="{{ URL::to('admin-dashboard') }}">
         <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
         <span class="menu-title">Dashboard</span>
         </a>
      </li>

      @if(auth()->user()->role == 'admin')
      <li class="nav-item">
         <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
            <span class="menu-title">Courses</span>
            <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="ui-basic" style="">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{ URL::to('/session') }}">Create Sessions</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{ URL::to('/courses') }}">Create Courses</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{ URL::to('assign/course/teacher') }}">Assign course teacher</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ URL::to('teacher/list') }}">
         <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
         <span class="menu-title">Teacher List</span>
         </a>
      </li>
      @endif

      @if(auth()->user()->role == 'teacher')
      <li class="nav-item">
         <a class="nav-link" href="{{ URL::to('teacher/section') }}">
         <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
         <span class="menu-title">Teacher Section</span>
         </a>
      </li>
      @endif

      @if(auth()->user()->role == 'student')
      <li class="nav-item">
         <a class="nav-link" href="{{ URL::to('/student/group') }}">
         <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
         <span class="menu-title">Group</span>
         </a>
      </li>
      @endif

      <li class="nav-item">
         <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
             <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
             
             <span class="menu-title">Logout</span>
             <form id="logout-form" action="{{ route('logout') }}" method="POST">
                 @csrf
             </form>
         </a>
      </li>
   </ul>
</nav>

