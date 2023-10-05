<aside>


    <div class=" list-group">
        <a class=" list-group-item list-group-item-action" href="">Home</a>
    </div>


    @user
        <p class=" my-3">MANAGEMENT</p>
        <div class=" list-group">
            <a class=" list-group-item list-group-item-action" href="{{ route('dashboard.home') }}">Dashboard</a>
        </div>


        <p class=" my-3">MANAGEMENT</p>
        <div class=" list-group">
            <a class=" list-group-item list-group-item-action">My Profile</a>
            <a class=" list-group-item list-group-item-action" href="{{ route('auth.passwordChange') }}">Change Password</a>
        </div>

        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button class=" btn btn-danger d-block w-100 mt-3">Logout</button>
        </form>
    @enduser

    @notUser
        <p class=" my-3">WELCOME</p>

        <div class=" list-group">
            <a class=" list-group-item list-group-item-action" href="{{ route('auth.register') }}">Register</a>
            <a class=" list-group-item list-group-item-action" href="{{ route('auth.login') }}">Login</a>
        </div>
    @endnotUser




</aside>
