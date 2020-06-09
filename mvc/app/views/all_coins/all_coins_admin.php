<?php
$coinModify = new Coin("", "", "", "", "", "", "", "", "", "", "");
$actionFinised = (isset($_SESSION['action-finised'])) ? $_SESSION['action-finised'] : '';
$modify_coin = (isset($_SESSION['modify-coin'])) ? $_SESSION['modify-coin'] : '';
$dbCoin = $this->getCoinById();
if ($dbCoin != null) {
    $coinModify = new Coin(
        $dbCoin['id'],
        $dbCoin['name'],
        $dbCoin['years'],
        $dbCoin['country'],
        $dbCoin['shape'],
        $dbCoin['size'],
        $dbCoin['weight'],
        $dbCoin['material'],
        $dbCoin['rarity_index'],
        "",
        ""
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>All the Coins!</title>
</head>

<body>

    <header class="header">
        <div class="logo">NumAX - Admin</div>
        <nav class="navbar">
            <ul class="navbar__items">
                <li id="hamburger__menu" onclick="hamburgerMenuOnClick()">
                    <div class="hamburger__bar1"></div>
                    <div class="hamburger__bar2"></div>
                    <div class="hamburger__bar3"></div>
                </li>
                <li class="navbar__item"><a href="http://localhost/numax/mvc/public/users">Users</a></li>
                <li class="navbar__item" id="navbar_selected"><a href="http://localhost/numax/mvc/public/allcoinsadmin">All coins</a></li>
                <li class="navbar__item__divider"></li>
                <li class="navbar__item logout"><a href="http://localhost/numax/mvc/public/login/logout">Logout</a></li>
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
                <form action="allcoinsadmin" . <?php $this->searched_coins() ?> method="post">
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
            </ul>
        </aside>
        <main class="coins">
            <ul class="coin__container">
                <?php
                $coins = $this->getCoins();
                // print_r($coins); 
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
                    echo '<span>' . $year . " | " . $coin['country']  . '</span>';
                    if ($coin['size'] != 0)
                        $size = $coin['size'];
                    else $size = "Unkown";
                    if ($coin['weight'] != 0)
                        $weight = $coin['weight'];
                    else $weight = "Unkown";
                    echo '<span>' . $coin['material'] . " | " . $size . "mm | " . $weight . 'g';
                ?>
                    <form action="allcoinsadmin/manageCoin" method="post">
                        <?php echo '<input type="hidden" name="coin-id-admin" value="' . $coin["id"] . '">'; ?>
                        <input type="submit" name="coin__modify" id="coin__modify" value="Modify" />
                        <input type="submit" name="coin__delete" value="Delete">
                    </form>
                <?php
                    echo '</span>';
                } ?>
            </ul>


            </form>
        </main>
    </div>
    <script src="javascript/my_coins.js"></script>

    <!-- Modal admin -->
    <div class="modal-modify-coin">
        <div class="modal-content">
            <p id="title-modal">Modify coin</p>
            <div class="close">+</div>
            <div class="modal-criteria">
                <form method="POST" action="allcoinsadmin/modifyCoin" enctype="multipart/form-data">
                    <div class="modal-input">
                        <label>Title:</label>
                        <?php echo '<input type="text" id="modal-title" name="title" placeholder="ex: Romania" value="' . $coinModify->name . '" required>'; ?>
                    </div>

                    <div class="modal-input">
                        <label>Country:</label>
                        <?php echo '<input type="text" id="modal-country" name="country" placeholder="ex: Romania" value="' . $coinModify->country. '" required>'; ?>
                    </div>

                    <div class="modal-input">
                        <label>Years:</label>
                        <?php echo '<input type="number" id="modal-years" name="years" placeholder="ex: 1939" value="' . $coinModify->years . '" required>'; ?>
                    </div>

                    <div class="modal-input">
                        <label>Shape:</label>
                        <?php echo '<input type="text" id="modal-shape" name="shape" placeholder="ex: round" value="' . $coinModify->shape . '" required>'; ?>
                    </div>

                    <div class="modal-input">
                        <label>Composition:</label>
                        <?php echo '<input type="text" id="modal-composition" name="composition" placeholder="ex: copper" value="' . $coinModify->material . '" required>'; ?>
                    </div>
                    <div class="modal-input">
                        <label>Size:</label>
                        <?php echo '<input type="text" id="modal-size" name="size" placeholder="ex: 34(mm)" value="' . $coinModify->size . '" required>'; ?>
                    </div>
                    <div class="modal-input">
                        <label>Weight:</label>
                        <?php echo '<input type="text" id="modal-weight" name="weight" placeholder="ex: 10.04g" value="' . $coinModify->weight . '" required>'; ?>
                    </div>
                    <!-- <div class="modal-input">
                        <label>Front image:</label>
                        <input type="file" name="modal-front_image" id="front-image" accept="image/*" class="file" required>
                    </div>
                    <div class="modal-input">
                        <label>Back image:</label>
                        <input type="file" name="modal-back_image" id="back-image" accept="image/*" class="file" required>
                    </div> -->
                    <input name="modify_coin_submit" id="submit-button" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>

    <script>
        var actionFinised = '<?php echo $actionFinised; ?>';
        var modify = '<?php echo $modify_coin; ?>';

        function show(blob) {
            var image = new Image();
            image.src = URL.createObjectURL(blob);
            document.getElementById("front-image").src = image;
        }

        if (modify == true) {
            document.querySelector('.modal-modify-coin').style.display = 'flex'
            '<?php $_SESSION["modify-coin"] = false ?>';
        }
        document.querySelector('.close').addEventListener('click', function() {
            document.querySelector('.modal-modify-coin').style.display = 'none'
        });

        if (actionFinised == "delete") {
            alert("Deleted succesfully");
            '<?php $_SESSION['action-finised'] = "" ?>';
        }
        if (actionFinised == "update") {
            alert("Update succesfully");
            '<?php $_SESSION['action-finised'] = "" ?>';
        }
        if (actionFinised == "deleteError") {
            alert("Deleted error!");
            '<?php $_SESSION['action-finised'] = "" ?>';
        }
        if (actionFinised == "updateError") {
            alert("Deleted error!");
            '<?php $_SESSION['action-finised'] = "" ?>';
        }
    </script>

</body>

</html>