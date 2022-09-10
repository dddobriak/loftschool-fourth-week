<?php

view('header');
view('message');
?>
<div>
    <h2>Login</h2>
    <form action="login" method="POST">
        <div>
            <label for="login_email">Email</label>
            <input id="login_email" name="email" type="text">
            <label for="login_password">Password</label>
            <input id="login_password" name="password" type="text">
            <button type="submit">Go</button>
        </div>
    </form>
</div>
<div>
    <h2>Register</h2>
    <form action="register" method="POST">
        <div>
            <label for="register_name">Name</label>
            <input id="register_name" name="name" type="text">
            <label for="register_email">Email</label>
            <input id="register_email" name="email" type="text">
            <label for="register_password">Password</label>
            <input id="register_password" name="password" type="text">
            <button type="submit">Go</button>
        </div>
    </form>
</div>
<?php
view('footer');
