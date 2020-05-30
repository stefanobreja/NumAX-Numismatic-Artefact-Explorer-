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
                <li class="navbar__item"><a href="http://localhost/numax/mvc/public/mycoins">My coins</a></li>
                <li class="navbar__item"><a href="http://localhost/numax/mvc/public/allcoins">All coins</a></li>
                <li class="navbar__item" id="navbar_selected">Statistics</li>
                <li class="navbar__item__divider"></li>
                <li class="navbar__item logout"><a href="http://localhost/numax/mvc/public/login">Logout</a></li>
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
                        <input type="submit" name="size" value="Size">
                    </li>
                    <li class="filter__item">
                        <input type="submit" value="Newest and oldest">
                    </li>
                </ul>
            </form>
        </aside>

        <div class="statistics">
            <table class="statistics-table">
                <tr>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Country</th>
                    <th>No.</th>
                </tr>

                <?php
                $list = $this->model->list;
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
            <form action="statistics/outputCSV" method="post">
                <input class="statistics-button" name="download" type="submit" value="Download">
            </form>

        </div>
    </div>
</body>

</html>