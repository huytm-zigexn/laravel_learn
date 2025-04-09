<nav>
    @auth
        <form action="/logout" method="POST">
            @csrf
            <input type="submit" value="Logout">
        </form>
    @else
        <a href="/register">Register</a>
        <a href="/login">Login</a>
    @endauth
</nav>