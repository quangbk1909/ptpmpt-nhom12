<nav id="sidebar" class="border">
    <div class="sidebar-header border-bottom">
        <h3>Procedural Task Management</h3>
    </div>

    <ul class="list-unstyled components ">
        <li>
            <a href="dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li >
            <a href="#postSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-edit"></i> 
                <span>Procedure</span>
            </a>
            <ul class="collapse list-unstyled" id="postSubmenu">
                <li>
                    <a href="procedure/show" class="active">Show</a>
                </li>
                <li>
                    <a href="procedure/create">Create</a>
                </li>
            </ul>
        </li>
        <li >
            <a href="#categorySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-list-ul"></i>
                <span>Task</span>
            </a>
            <ul class="collapse list-unstyled" id="categorySubmenu">
                <li>
                    <a href="main-task/show" class="active">Show</a>
                </li>
                <li>
                    <a href="main-task/create">Create</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>