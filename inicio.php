<?php

error_reporting(E_ALL);
ini_set("display_errors", true);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $output = "";
    $remember = false;
    if (!empty($_POST['username'])) {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $output .= "Hello: " . $username ."<br>".PHP_EOL;
        setcookie("username", $username, time()+3600); /* expire in 1 hour */
    }
    if (!empty($_POST['password'])) {
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $output .= "Your Password is " . $password."<br>".PHP_EOL;
        setcookie("password", $password, time()+3600); /* expire in 1 hour */
    }
    if (isset($_POST['remember'])) {
        $remember = true;
        setcookie("cookie_username", $username, time()+3600); /* expire in 1 hour */
        setcookie("cookie_password", $password, time()+3600); /* expire in 1 hour */
    }

    echo $output.PHP_EOL;

} else {
    $form_html = <<<HTML
    <form action="inicio.php" method="POST">
	    <fieldset>
		    <label for="username">Username</label>
		    <input type="text" id="username" name="username" class="form-text" />
		    <br>
		    <label for="password">Password</label>
		    <input type="password" id="password" name="password" class="password" required />
		    <br>
		    <label>
		    <!-- Se le debe de agregar una cookie para que guarde los datos de sesión -->
            <input id ="remember" type="checkbox" checked="checked" name="remember"> Remember me
            </label>
         <br>
		    <input type="submit" value="Login" />
	    </fieldset>
    </form>
HTML;
    echo $form_html;
}