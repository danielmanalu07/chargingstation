<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ url('/admin/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Cars Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/admin/car') }}">
                        <i class="bi bi-circle"></i><span>Cars Index</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/car/create') }}">
                        <i class="bi bi-circle"></i><span>Cars Create</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#cars-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Category Cars data</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="cars-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/admin/categorycar') }}">
                        <i class="bi bi-circle"></i><span>Category Cars Index</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/categorycar/create') }}">
                        <i class="bi bi-circle"></i><span>Category Cars Create</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#plugs-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Plugs data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="plugs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/admin/plugs') }}">
                        <i class="bi bi-circle"></i><span>Plugs Index</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/plugs/create') }}">
                        <i class="bi bi-circle"></i><span>Plugs Create</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#voltage-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Voltage data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="voltage-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/admin/voltages') }}">
                        <i class="bi bi-circle"></i><span>Voltage Index</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/voltages/create') }}">
                        <i class="bi bi-circle"></i><span>Voltage Create</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#capacity-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Capacity data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="capacity-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/admin/capacities') }}">
                        <i class="bi bi-circle"></i><span>Capacity Index</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/capacities/create') }}">
                        <i class="bi bi-circle"></i><span>Capacity Create</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#customer-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Customer data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="customer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/admin/customers') }}">
                        <i class="bi bi-circle"></i><span>Customer Index</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->

    </ul>

</aside><!-- End Sidebar-->