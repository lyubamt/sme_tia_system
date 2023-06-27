<nav class="navbar navbar-expand-lg navbar-light bg-light side-navigation-small">
    <!-- <a class="navbar-brand" href="#">SME-Business System</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @hasanyrole("Admin")
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ route('admin.user.index') }}">Users</a>
            <a class="dropdown-item" href="{{ route('admin.role.index') }}">Roles</a>
            <a class="dropdown-item" href="{{ route('admin.system_settings.system_setting.index') }}">Settings</a>
            <a class="dropdown-item" href="{{ route('admin.user_login_logs.user_login_log.index') }}">Sign In Logs</a>
            <a class="dropdown-item" href="{{ route('admin.logs.log.index') }}">Activity Logs</a>
            </div>
        </li>
       

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.transaction_categories.transaction_category.index') }}">Categories</a>
        </li>

        @endhasanyrole

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.items.item.index') }}">Items</a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.units.unit.index') }}">Units</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.transactions.transaction.index') }}">Transactions</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Analysis & Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ route('admin.reports.report.profit_and_loss') }}">Profit & Loss</a>
            </div>
        </li>

        @hasanyrole("Admin")
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Location(s)
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ route('admin.regions.region.index') }}">Regions</a>
            <a class="dropdown-item" href="{{ route('admin.districts.district.index') }}">Districts</a>
            </div>
        </li>

        @endhasanyrole

        <li class="nav-item active" data-toggle="modal" data-target="#change-password-modal">
            <a class="nav-link">Change Password</a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('logout') }}">Log Out</a>
        </li>
     
        </ul>
    </div>
</nav>