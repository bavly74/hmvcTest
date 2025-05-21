<div class="sidebar bg-dark text-white vh-100 p-3" style="width: 250px;">
    <h4 class="mb-4">Admin Panel</h4>

    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}" class="nav-link text-white">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('users.index') }}" class="nav-link text-white">
                <i class="bi bi-people"></i> Users
            </a>
        </li>


        <li class="nav-item mb-2">
            <a href="{{ route('users.create') }}" class="nav-link text-white">
                <i class="bi bi-people"></i>Create Users
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="bi bi-shield-lock"></i> Roles
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="bi bi-file-text"></i> Posts
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="bi bi-gear"></i> Settings
            </a>
        </li>
    </ul>
</div>
