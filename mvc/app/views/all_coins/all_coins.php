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
            <li class="navbar__item"><a href="http://localhost/numax-php/mvc/public/mycoins">My coins</a></li>
            <li class="navbar__item" id="navbar_selected"><a href="#">All coins</a></li>
            <li class="navbar__item"><a href="http://localhost/numax-php/mvc/public/statistics">Statistics</a></li>
            <li class="navbar__item__divider"></li>
            <li class="navbar__item logout"><a href="#">Logout</a></li>

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
                <label for="name">Name:</label>
                <input type="text" id="name" placeholder="ex: 100 Lei - Carol II">
            </li>
            <li class="filter__item">
                <label for="year">Year:</label>
                <input type="number" id="year" placeholder="ex: 1939">
            </li>
            <li class="filter__item">
                <label for="country">Country:</label>
                <input type="text" id="country" placeholder="ex: Romania">
            </li>
            <li class="filter__item">
                <label for="shape">Shape:</label>
                <input type="text" id="shape" placeholder="ex: round">
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
                            <button class="coin__button" type="button">Add</button>
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
                            <button class="coin__button" type="button">add</button>
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
</body>

</html>