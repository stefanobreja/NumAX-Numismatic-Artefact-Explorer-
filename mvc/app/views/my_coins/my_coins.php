<!DOCTYPE html>
<html lang="en">

<?php
$coins = $this->getCoins();
$coinAdd = new Coin("", "", "", "", "", "", "", "", "", "", "");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>My coins</title>
</head>

<body>
    <header class="header">
        <!-- <div class="logo-image">
        <img src="./logo3.jpg" alt="logo-image">
    </div> -->
        <div class="logo">NumAX</div>
        <!-- <div class="welcome">Welcome, User!</div> -->
        <nav class="navbar">
            <ul class="navbar__items">
                <li id="hamburger__menu" onclick="hamburgerMenuOnClick()">
                    <div class="hamburger__bar1"></div>
                    <div class="hamburger__bar2"></div>
                    <div class="hamburger__bar3"></div>
                </li>
                <li class="navbar__item" id="navbar_selected"><a href="http://127.0.0.1/numax/mvc/public/mycoins">My coins</a></li>
                <li class="navbar__item"><a href="http://127.0.0.1/numax/mvc/public/allcoins">All coins</a></li>
                <li class="navbar__item"><a href="http://127.0.0.1/numax/mvc/public/statistics">Statistics</a></li>
                <li class="navbar__item__divider"></li>
                <li class="navbar__item logout"><a href="http://127.0.0.1/numax/mvc/public/login/logout">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="main">
        <aside class="filter">
            <div class="filter__title">
                <label class="filter__label">Search by:</label>
                <label class="filter__arrow" onclick="arrowPressed()">&lt;</label>
            </div>
            <ul class="filter__items">
                <form action="mycoins" . <?php $this->searched_coins() ?> method="post">
                    <li class="filter__item">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="ex: 100 Lei - Carol II">
                    </li>
                    <li class="filter__item">
                        <label for="year">Min Year - Max Year:</label>
                        <input type="text" id="year" name="year" placeholder="ex: 1939-1950">
                    </li>
                    <li class="filter__item">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" placeholder="ex: Romania">
                    </li>
                    <li class="filter__item">
                        <label for="shape">Shape:</label>
                        <input type="text" id="shape" name="shape" placeholder="ex: round">
                    </li>
                    <li class="filter__item">
                        <label for="material">Material:</label>
                        <input type="text" id="material" name="material" placeholder="ex: copper">
                    </li>
                    <li class="filter__item">
                        <input type="submit" value="Search">
                    </li>
                </form>
                <li id="button-add" class="filter__item">
                    <input type="submit" value="Add a new coin">
                </li>
            </ul>
        </aside>

        <main class="coins">
            <ul class="coin__container">
                <?php
                // print_r($coins);
                $coins = $this->getCoins();
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
                    <form action="mycoins/manageButton" method="post">
                        <input type="submit" name="coin__share" value="Share">
                        <input type="submit" name="coin__delete" value="Delete">
                        <?php echo '<input type="hidden" name="coin-id" value="' . $coin["id"] . '">'; ?>
                    </form>
                    </span>
                <?php }
                ?>
            </ul>
        </main>
    </div>


    <!-- Modal section -->
    <div class="modal-add-coin">
        <div class="modal-content">
            <p id="title-modal">Add a new coin to your collection</p>
            <div class="close">+</div>
            <div class="modal-criteria">
                <form method="POST" action="mycoins/addCoin" enctype="multipart/form-data">
                    <div class="modal-input">
                        <label>Import coin data:</label>
                        <input type="file" name="import-coin" id="import-coin" class="file">
                    </div>
                    <div class="modal-input">
                        <label>Title:</label>
                        <?php echo '<input type="text" id="title" name="title" placeholder="ex: Romania" value="' . $coinAdd->name . '" required>'; ?>
                    </div>

                    <div class="modal-input">
                        <label>Country:</label>
                        <?php echo '<input type="text" id="country" name="country" placeholder="ex: Romania" value="' . $coinAdd->country . '">'; ?>
                    </div>

                    <div class="modal-input">
                        <label>Years:</label>
                        <?php echo '<input type="number" id="min-year" name="min-year" placeholder="ex: 1939" value="' . $coinAdd->years . '">'; ?>
                    </div>

                    <div class="modal-input">
                        <label>Shape:</label>
                        <?php echo '<input type="text" id="shape" name="shape" placeholder="ex: round" value="' . $coinAdd->shape . '">'; ?>
                    </div>

                    <div class="modal-input">
                        <label>Composition:</label>
                        <?php echo '<input type="text" id="composition" name="composition" placeholder="ex: copper" value="' . $coinAdd->material . '" >'; ?>
                    </div>
                    <div class="modal-input">
                        <label>Size:</label>
                        <?php echo '<input type="text" id="size" name="size" placeholder="ex: 34(mm)" value="' . $coinAdd->size . '" >'; ?>
                    </div>
                    <div class="modal-input">
                        <label>Weight:</label>
                        <?php echo '<input type="text" id="weight" name="weight" placeholder="ex: 10.04g" value="' . $coinAdd->weight . '">'; ?>
                    </div>
                    <div class="modal-input">
                        <label>Front image:</label>
                        <input type="file" name="front_image" id="front-image" class="file" required>
                    </div>
                    <div class="modal-input">
                        <label>Back image:</label>
                        <input type="file" name="back_image" id="back-image" class="file" required>
                    </div>

                    <input name="add_coin_submit" id="submit-button" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>

    <script src="javascript/my_coins.js">

    </script>
</body>

</html>