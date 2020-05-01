<!DOCTYPE html>
<html lang="en">

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
            <li class="navbar__item" id="navbar_selected"><a href="#">My coins</a></li>
            <li class="navbar__item"><a href="http://localhost/numax-php/mvc/public/allcoins">All coins</a></li>
            <li class="navbar__item"><a href="http://localhost/numax-php/mvc/public/statistics">Statistics</a></li>
            <li class="navbar__item__divider"></li>
            <li class="navbar__item logout"><a href="http://localhost/numax-php/mvc/public/login">Logout</a></li>
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
            <li class="filter__item">
                <label>Name</label>
                <select class="filter-select" id="filter-name">
                    <option class="select-items" value="1 Apsar The Dormition Cathedral of Dranda">1 Apsar The
                        Dormition Cathedral of
                        Dranda
                    </option>
                </select>
            </li>
            <li class="filter__item">
                <label>Year</label>
                <select class="filter-select" id="filter-year">
                    <option class="select-items" value="1935">1935</option>
                </select>
            </li>
            <li class="filter__item">
                <label>Country</label>
                <select class="filter-select" id="filter-country">
                    <option class="select-items" value="abkhazia">Abkhazia</option>
                </select>
            </li>
            <li class="filter__item">
                <label>Shape</label>
                <select class="filter-select" id="filter-shape">
                    <option class="select-items" value="round">Round</option>
                </select>
            <li id="button-add" class="filter__item">
                <input type="submit" value="Add a new coin">
            </li>
            <li class="filter__item">
                <input type="submit" value="Search!">
            </li>

        </ul>
    </aside>

    <main class="coins">
        <ul class="coin__container">
            <li class="coin">
                <div class="coin__images">
                    <img src="../../../public/src/face-coin.jpg" alt="coin photo">
                    <img src="../../../public/src/back-coin.jpg" alt="coin photo">
                </div>
                <div class="coin__info">
                        <span>
                            1 Apsar The Dormition Cathedral of Dranda
                        </span>
                    <span>
                            1935
                        </span>
                    <span>
                            Bronze | 2.3g | 18.6mm
                            <button class="coin__button" type="button">share</button>
                        </span>
                </div>
            </li>
            <li class="coin">
                <div class="coin__images">
                    <img src="../../../public/src/face-coin.jpg" alt="coin photo">
                    <img src="../../../public/src/back-coin.jpg" alt="coin photo">
                </div>
                <div class="coin__info">
                        <span>
                            1 Apsar The Dormition Cathedral of Dranda
                        </span>
                    <span>
                            1935
                        </span>
                    <span>
                            Bronze | 2.3g | 18.6mm
                        </span>
                </div>
            </li>
            <li class="coin">
                <div class="coin__images">
                    <img src="../../../public/src/face-coin.jpg" alt="coin photo">
                    <img src="../../../public/src/back-coin.jpg" alt="coin photo">
                </div>
                <div class="coin__info">
                        <span>
                            1 Apsar The Dormition Cathedral of Dranda
                        </span>
                    <span>
                            1935
                        </span>
                    <span>
                            Bronze | 2.3g | 18.6mm
                        </span>
                </div>
            </li>
        </ul>
    </main>
</div>
<!-- Modal section -->
<div class="modal-add-coin">
    <div class="modal-content">
        <p id="title-modal">Add a new coin to your collection</p>
        <div class="close">+</div>
        <div class="modal-criteria">

            <div class="modal-input">
                <label>Country:</label>
                <input type="text" id="modal-add-country" placeholder="ex: Romania">
            </div>

            <div class="modal-input">
                <label>Min. Year:</label>
                <input type="number" id="modal-add-min-year" placeholder="ex: 1939">
            </div>

            <div class="modal-input">
                <label>Year:</label>
                <input type="number" id="modal-add-year" placeholder="ex: 1939">
            </div>

            <div class="modal-input">
                <label>Max. Year:</label>
                <input type="number" id="modal-add-max-year" placeholder="ex: 1939">
            </div>

            <div class="modal-input">
                <label>Shape:</label>
                <input type="text" id="modal-add-shape" placeholder="ex: round">
            </div>

            <div class="modal-input">
                <label>Composition:</label>
                <input type="text" id="modal-add-composition" placeholder="ex: copper">
            </div>
        </div>
        <input id="submit-button" type="submit" value="Submit">
    </div>
</div>

<script src="../../../public/javascript/my_coins.js"></script>

</body>
</html>