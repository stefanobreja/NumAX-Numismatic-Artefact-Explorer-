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
                <li class="navbar__item"><a href="http://127.0.0.1/numax/mvc/public/mycoins">My coins</a></li>
                <li class="navbar__item"><a href="http://127.0.0.1/numax/mvc/public/allcoins">All coins</a></li>
                <li class="navbar__item" id="navbar_selected"><a href="http://127.0.0.1/numax/mvc/public/statistics">Statistics</a></li>
                <li class="navbar__item__divider"></li>
                <li class="navbar__item logout"><a href="http://127.0.0.1/numax/mvc/public/login/logout">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="main">
        <aside class="filter">
            <label class="filter__label">Search by:</label>
            <form action="statistics" <?php $this->manageButtonClick() ?> method="post">
                <ul class="filter__items">
                    <li class="filter__item">
                        <input type="submit" name="most-popular" value="Most popular">
                    </li>
                    <li class="filter__item">
                        <input type="submit" name="rarest" value="Rarest">
                    </li>
                    <li class="filter__item">
                        <input type="submit" name="rss_file" value="Generate RSS file" onclick="showAlert()">

                    </li>
                </ul>
            </form>
        </aside>

        <div class="statistics">
            <div class="table_div">
                <table class="statistics-table">
                    <tr>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Country</th>
                    </tr>

                    <?php
                    $list = $this->getList();
                    foreach ($list as $item) {
                        echo
                            '<tr>
                            <td> ' . $item["name"] . '</td>
                            <td>' . $item["years"] . '</td>
                            <td>' . $item["country"] . '</td>
                        </tr>';
                    }

                    ?>
                </table>
            </div>
            <form action="statistics/outputCSV" method="post">
                <input class="statistics-button" name="download-csv" type="submit" value="Download">
                <!-- <input class="statistics-button" name="download-pdf" type="submit" value="Download"> -->
            </form>

        </div>
        <script src="javascript/my_coins.js"></script>

    </div>
</body>
<script src="javascript/my_coins.js"></script>

</html>