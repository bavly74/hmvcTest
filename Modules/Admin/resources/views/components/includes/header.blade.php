    <!-- Header -->
    <header class="bg-dark text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Admin Dashboard</h1>
            <nav>
                <a href="#" class="text-white me-3">Dashboard</a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </nav>
        </div>
    </header>
