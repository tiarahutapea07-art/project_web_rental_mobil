<h2>Login</h2>

<form method="POST" action="/login">
    @csrf
    <input type="text" name="username" placeholder="Username"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Login</button>
</form>