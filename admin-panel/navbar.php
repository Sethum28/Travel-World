<nav class="navbar navbar-dark bg-dark position-fixed top-0 end-0"
     style="left:260px; right:0; z-index:1020;">

    <div class="container-fluid">

        <!-- Dashboard Title -->
        <span class="navbar-brand">
            <i class="fas fa-bars"></i> Admin Dashboard
        </span>

        <!-- Search Box -->
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>

        <!-- User Dropdown -->
        <div class="dropdown">

            <button class="btn btn-dark dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">

                <i class="fas fa-user-circle"></i> Admin

            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item" href="login.php">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="profile.php">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="settings.php">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-danger" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>