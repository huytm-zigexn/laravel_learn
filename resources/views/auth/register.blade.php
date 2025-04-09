@extends('app')

@section ('content')
    <h2>Register</h2>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/register" method="POST">
        @csrf
        <label for="name">Name</label><br>
        <input type="text" name="name" placeholder="Input your name"><br>
        <label for="Email">Email</label><br>
        <input type="email" name="email" id="" placeholder="Input your email"><br>
        <label for="password">password</label><br>
        <input type="password" name="password" id=""><br>
        <a href="/login">Login</a>
        <input type="submit" value="Register">
    </form>
@endsection