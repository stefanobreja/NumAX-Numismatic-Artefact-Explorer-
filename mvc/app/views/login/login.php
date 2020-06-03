<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='css/loginForm.css'>
    <title>Login - numAX</title>
</head>

<body>
<div>
    <div class="title">
        <h4>Login</h4>
    </div>
    <div class="log_in">
        <form method="POST" class="login_form" action="login/authenticate">
            <div class="form">
                <br>
                <input id="login_email" type="text" name='username' class="form_input" placeholder="Username" required>
            </div>
            <div class="form">
                <br>
                <input id="login_password" type="password" name='pass' class="form_input" placeholder="Parola"
                       required>
            </div>
            <!-- <p><a href="#">Ai uitat parola?</a></p> -->
            <div class="buttons">
                <input type="button" onclick="window.location.href = 'http://localhost/numax/mvc/public/register'"
                       value="    Register    ">
                <input type="submit" value="    Login    ">
            </div>
        </form>
    </div>
    <div class="error">
        <?php echo Session::get("error") ?>
    </div>
</div>
</body>

</html>