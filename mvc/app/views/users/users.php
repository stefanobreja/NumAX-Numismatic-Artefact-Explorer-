<?php
$session_value = (isset($_SESSION['error'])) ? $_SESSION['error'] : ''
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Users Page</title>
</head>

<body>

    <header class="header">
        <div class="logo">NumAX</div>
        <nav class="navbar">
            <ul class="navbar__items">
                <li id="hamburger__menu" onclick="hamburgerMenuOnClick()">
                    <div class="hamburger__bar1"></div>
                    <div class="hamburger__bar2"></div>
                    <div class="hamburger__bar3"></div>
                </li>
                <li class="navbar__item" id="navbar_selected"><a href="http://localhost/numax/mvc/public/users">Users</a></li>
                <li class="navbar__item"><a href="http://localhost/numax/mvc/public/allcoins">All coins</a></li>
                <li class="navbar__item__divider"></li>
                <li class="navbar__item logout"><a href="http://localhost/numax/mvc/public/login/logout">Logout</a></li>

            </ul>
        </nav>
    </header>
    <div class="main">
        <aside class="filter">
            <div class="filter__title">
                <label class="filter__label">Search user:</label>
                <label class="filter__arrow" onclick="arrowPressed()">&lt;</label>
            </div>
            <ul class="filter__items">
                <form action= "users" . <?php $this->selectOption() ?> method="post">
                    <li class="filter__item">
                        <label for="name">Username:</label>
                        <select class="user_options" id="name" name="name" size="10">
                            <?php
                                $users = $this->getUsers();
                                print_r($users);
                                foreach ($users as $user) {
                                    echo "<option class='user_option' value=" . $user['username'] . ">" . $user['username'] . "</option> ";
                                }
                            ?>
                        </select>
                    </li>
                    <li class="filter__item">
                        <input type="submit" value="Search">
                    </li>
                </form>
            </ul>
        </aside>
        <main class="coins">
            <?php 
                if (Session::get("username_selected") != false) {
                    $username = Session::get("username_selected");
                    echo "<form action='users/deleteUser' method='post' class= 'stats_buttons'>";
                    echo "<label class='username_intro'>Username: " . Session::get("username_selected") . "</label>";
                    echo "<input class='statistics-button' name='delete_user' type='submit' value='Delete user'>";
                    echo '<input type="hidden" name="del_user" value="' . $username . '"></form>';
                }
            ?>
            <ul class="coin__container">
            <?php
                // print_r($coins);
                $username = $this->getUsername();
                $coins = $this->getUserCoins();
                // $random_list = shuffle($coins);
                foreach ($coins as $coin) {
                    $fImage = $coin['front_picture'];
                    $bImage = $coin['back_picture'];
                    $encFrontIamge = base64_encode($fImage);
                    $encBackIamge = base64_encode($bImage);
                    $frontImg = "<img src='data:image/jpeg;base64,{$encFrontIamge}' alt=''>";
                    $backImg = "<img src='data:image/jpeg;base64,{$encBackIamge}' alt=''>";

                    // pictures
                    echo '<li class="coin"> <div class="coin__images">';
                    echo $frontImg;
                    echo $backImg;
                    echo '</div>';
                    // info
                    echo '<div class="coin__info">';
                    echo '<span>' . $coin['name'] . '</span>';
                    if ($coin['years'] == 0) {
                        $year = "Unkown";
                    } else $year = $coin['years'];
                    echo '<span>' . $year . " | " . $coin['country'] . '</span>';
                    if ($coin['size'] != 0)
                        $size = $coin['size'];
                    else $size = "Unkown";
                    if ($coin['weight'] != 0)
                        $weight = $coin['weight'];
                    else $weight = "Unkown";
                    echo '<span>' . $coin['material'] . " | " . $size . "mm | " . $weight . "g";
                ?>
                    <form action="users/deleteCoin" method="post">
                        <input type="submit" name="coin__delete" value="Delete">
                        <?php echo '<input type="hidden" name="coin-id" value="' . $coin["id"] . '">'; ?>
                        <?php echo '<input type="hidden" name="username" value="' . $username . '">'; ?>
                    </form>
                    </span>
                <?php }
                ?>
            </ul>
            </form>
        </main>
    </div>
    <script src="javascript/my_coins.js"></script>

    <script>
        var myvar = '<?php echo $session_value; ?>';
        '<?php $_SESSION["error"] = "" ?>';
        if (myvar != "") {
            alert("Coin already in your collection")
        }

        function show(blob) {
            var image = new Image();
            image.src = URL.createObjectURL(blob);
            document.getElementById("front-image").src = image;
        }
    </script>

</body>

</html>