<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginForm.css">
    <title>Register - numAX</title>
</head>

<body>
    <div>
        <div class="title">
            <h4>Register</h4>
        </div>
        <div class="log_in">
            <form method="POST" action="register/register" class="login_form">
                <div class="form">
                    <input id="login_name" name='name' type="text" class="form_input" placeholder="Username"
                        required>
                </div>
                <div class="form">
                    <br>
                    <input id="login_email" name='email' type="text" class="form_input" placeholder="Email" required>
                </div>
                <div class="form">
                    <br>
                    <input id="login_password" name='pass' type="password" class="form_input" placeholder="Parola"
                        required>
                </div>
                <div class="form">
                    <br>
                    <input id="login_repeat_password" name='repeat_pass' type="password" class="form_input"
                        placeholder="Repetati parola" required>
                </div>
                <br>
                <div class="buttons" style="padding-top:10px;">
                    <input type="button" onclick="window.location.href = 'http://localhost/numax/mvc/public/login'" value="   Go to login   ">
                    <input type="submit" value="   Register   ">
                </div>
            </form>
        </div>
        <div class="error">
        <?php echo Session::get("error") ?>
    </div>
    </div>
</body>

</html>