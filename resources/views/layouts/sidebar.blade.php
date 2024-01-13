<div class="d-none d-md-flex flex-column flex-shrink-0 p-3 rounded shadow-sm bg-white">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-primary text-decoration-none">
        <span class="fs-4">{{ env('APP_NAME') }}</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link @active($request->is('home'))" aria-current="page">
                Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('companies.index') }}" class="nav-link @active($request->is('companies*'))" aria-current="page">
                Companies
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employees.index') }}" class="nav-link @active($request->is('employees*'))" aria-current="page">
                Employees
            </a>
        </li>
        <li class="nav-item">
            <a data-method="POST" href="{{ route('logout') }}" class="nav-link" aria-current="page">
                Logout
            </a>
        </li>
    </ul>
</div>
