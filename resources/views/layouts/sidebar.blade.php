<div class="card px-3 border-primary">
    <div class="card-body">
        <div class="dropdown">
            <div role="button" class="dropdown-toggle d-flex align-items-center text-primary" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-check fs-3 me-2"></i>
                <span>{{ Auth::user()->name }}</span>
            </div>
            <ul class="dropdown-menu">
              <li>
                    <a class="dropdown-item text-primary" href="#">
                        <i class="bi bi-pencil me-2"></i>
                        <span>Edit Profile</span>
                    </a>
                </li>
              <li>
                <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left me-2"></i>
                    <span>{{ __('Logout') }}</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </li>
            </ul>
        </div>
        {{-- <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

            </div>
        </li> --}}
    </div>
</div>

<div class="list-group mt-3">
    <a href="#" class="list-group-item list-group-item-action px-3 text-primary" aria-current="true">
        <i class="bi bi-speedometer2 me-2"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{route('transaction.index')}}" class="list-group-item list-group-item-action px-3 text-primary">
        <i class="bi bi-cash-coin me-2"></i>
        <span>Transactions</span>
    </a>
    <a href="{{route('category.index')}}" class="list-group-item list-group-item-action text-primary px-3">
        <i class="bi bi-card-list me-2"></i>
        <span>Categories</span>
    </a>
</div>
