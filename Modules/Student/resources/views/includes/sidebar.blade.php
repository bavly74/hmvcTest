    <div class="sidebar">
        <a href="#">Dashboard</a>
        <a href="{{ route('courses.index') }}">My Courses</a>
        <a href="#">Profile</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
