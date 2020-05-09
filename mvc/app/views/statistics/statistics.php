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
        <ul class="filter__items">
            <li class="filter__item">
                <input type="submit" value="Most popular">
            </li>
            <li class="filter__item">
                <input type="submit" value="Size">
            </li>
            <li class="filter__item">
                <input type="submit" value="Newest and oldest">
            </li>
        </ul>
    </aside>

    <div class="statistics">
        <table class="statistics-table">
            <tr>
                <th>Name</th>
                <th>Year</th>
                <th>Country</th>
                <th>No.</th>
            </tr>
            <tr>
                <td> 1 Apsar The Dormition Cathedral of Dranda</td>
                <td>1935</td>
                <td>Abkhazia</td>
                <td>4</td>
            </tr>
            <tr>
                <td> 2 Apsar The Dormition Cathedral of Dranda</td>
                <td>1935</td>
                <td>Abkhazia</td>
                <td>2</td>
            </tr>
            <tr>
                <td> 3 Apsar The Dormition Cathedral of Dranda</td>
                <td>1935</td>
                <td>Abkhazia</td>
                <td>1</td>
            </tr>
        </table>
        <input class="statistics-button" type="button" value="Download">
    </div>
</div>
</body>

</html>