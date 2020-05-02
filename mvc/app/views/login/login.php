<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='css/loginForm.css'>
    <title>My coins</title>
</head>

<body>
<div>
    <div class="title">
        <h4>Autentificare</h4>
    </div>
    <div class="log_in">
        <form method="POST" class="login_form">
            <div class="form">
                <br>
                <input id="login_email" type="text" name='email' class="form_input" placeholder="Email" required>
            </div>
            <div class="form">
                <br>
                <input id="login_password" type="password" name='pass' class="form_input" placeholder="Parola"
                       required>
            </div>
            <p><a href="#">Ai uitat parola?</a></p>
            <div class="buttons">
                <input type="button" onclick="window.location.href = 'http://localhost/numax-php/mvc/public/register'"
                       value="Inregistreaza-te">
                <input type="submit" onclick="window.location.href = 'http://localhost/numax-php/mvc/public/mycoins'"
                       name="op" value="Intra in cont">
            </div>
        </form>
    </div>
</div>
</body>

</html>