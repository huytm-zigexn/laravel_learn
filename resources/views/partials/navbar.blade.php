<nav>
    @auth
        <form action={{ route('logout') }} method="POST">
            @csrf
            <input type="submit" value="Logout">
        </form>
    @else
        <a href={{ route('get_register') }}>Register</a>
        <a href={{ route('get_login') }}>Login</a>
    @endauth
</nav>