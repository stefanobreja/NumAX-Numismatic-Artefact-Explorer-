<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Statistics</title>
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
                <li class="navbar__item"><a href="http://localhost/numax/mvc/public/mycoins">My coins</a></li>
                <li class="navbar__item"><a href="http://127.0.0.1/numax/mvc/public/allcoins">All coins</a></li>
                <li class="navbar__item" id="navbar_selected"><a href="http://localhost/numax/mvc/public/statistics">Statistics</a></li>
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
            <form action="statistics" <?php $this->manageButtonClick() ?> method="post">
                <ul class="filter__items">
                    <li class="filter__item">
                        <input type="submit" name="most-popular" value="Top 10 Most Popular Coins">
                    </li>
                    <li class="filter__item">
                        <input type="submit" name="rarest" value="Top 10 Rarest Coins">
                    </li>
                    <li class="filter__item">
                        <input type="submit" name="smallest" value="Top 10 Smallest Coins">
                    </li>
                    <li class="filter__item">
                        <input type="submit" name="rss_file" value="RSS file - most popular">
                    </li>
                </ul>
            </form>
        </aside>

        <main class="coins">
            <form action="statistics" <?php $this->output() ?> method="post" class="stats_buttons">
                <input class="statistics-button" name="download-csv" type="submit" value="Download CSV">
                <input class="statistics-button" name="download-pdf" type="submit" value="Download PDF">
                <?php echo '<input type="hidden" name="coins" value="' . base64_encode(serialize($this->getList())) . '">'; ?>
                 <!-- <input class="statistics-button" name="download-pdf" type="submit" value="Download"> -->
            </form>
            <ul class="coin__container">
                <?php
                $coins = $this->getList();
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
                    echo '<span>' . $coin['material'] . " | " . $size . "mm | " . $weight . "g</span>";
                }
                ?>
            </ul>
        </main>
        <script src="javascript/my_coins.js"></script>
    </div>
</body>
<script src="javascript/my_coins.js"></script>

</html>