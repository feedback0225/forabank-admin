<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Fora Landings</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Пользователи
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDown"
            aria-expanded="true" aria-controls="taTpDropDown">
            <i class="fas fa-user-alt"></i>
            <span>Пользователи</span>
        </a>
        <div id="taTpDropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Действия :</h6>
                <a class="collapse-item" href="{{ route('users.index') }}">Список</a>
                <a class="collapse-item" href="{{ route('users.create') }}">Добавить</a>
                <a class="collapse-item" href="{{ route('users.import') }}">Импорт данных</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Адреса Оффисов
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Tp1DropDown"
           aria-expanded="true" aria-controls="Tp1DropDown">
            <i class="fas fa-building"></i>
            <span>Оффисы и банкоматы</span>
        </a>
        <div id="Tp1DropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Действия:</h6>
                <a class="collapse-item" href="{{ route('offices.index') }}">Список</a>
                <a class="collapse-item" href="{{ route('offices.create') }}">Добавить</a>
                <a class="collapse-item" href="{{ route('offices.import') }}">Импорт из .exc</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Tp2DropDown"
           aria-expanded="true" aria-controls="Tp2DropDown">
            <i class="fas fa-city"></i>
            <span>Города</span>
        </a>
        <div id="Tp2DropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Действия:</h6>
                <a class="collapse-item" href="{{ route('cities.index') }}">Список</a>
                <a class="collapse-item" href="{{ route('cities.create') }}">Добавить</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Tp3DropDown"
           aria-expanded="true" aria-controls="Tp3DropDown">
            <i class="fas fa-calendar"></i>
            <span>Графики работ</span>
        </a>
        <div id="Tp3DropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Действия:</h6>
                <a class="collapse-item" href="{{ route('work_schedules.index') }}">Список</a>
                <a class="collapse-item" href="{{ route('work_schedules.create') }}">Добавить</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Tp4DropDown"
           aria-expanded="true" aria-controls="Tp4DropDown">
            <i class="fas fa-user-alt"></i>
            <span>Типы Клиентов</span>
        </a>
        <div id="Tp4DropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Действия:</h6>
                <a class="collapse-item" href="{{ route('type_of_clients.index') }}">Список</a>
                <a class="collapse-item" href="{{ route('type_of_clients.create') }}">Добавить</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Tp5DropDown"
           aria-expanded="true" aria-controls="Tp5DropDown">
            <i class="fas fa-dollar-sign"></i>
            <span>Валюты</span>
        </a>
        <div id="Tp5DropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Действия:</h6>
                <a class="collapse-item" href="{{ route('currencies.index') }}">Список</a>
                <a class="collapse-item" href="{{ route('currencies.create') }}">Добавить</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @hasrole('Admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Section
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Masters</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Role & Permissions</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endhasrole

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
