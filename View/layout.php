<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Programme TV</title>
        <link rel="stylesheet" href="/tele/public/styles/foundation.min.css"/>
    </head>
    <body>
        <header>
            <div class="row">
                <div class="columns small-12">
                    <nav class="top-bar" data-topbar role="navigation">
                        <ul class="title-area">
                            <li class="name">
                                <h1><a href="/">Programme TV</a></h1>
                            </li>
                            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                        </ul>

                        <section class="top-bar-section">
                            <!-- Left Nav Section -->
                            <ul class="left">
                                <?php $pathInfo = $_SERVER['PATH_INFO']; ?>
                                <?php $class = strpos($pathInfo, '/chaine') === 0 || $pathInfo === '/' ? 'class="active"' : ''; ?>
                                <li <?= $class ?>><a href="/">Chaines</a></li>

                                <?php $class = strpos($pathInfo, '/programme') === 0 ? 'class="active"' : ''; ?>
                                <li <?= $class ?>><a href="/programmes">Programmes</a></li>
                            </ul>
                        </section>
                    </nav>
                </div>
            </div>
        </header>
        <div class="row">
            <?= $content ?>
        </div>
        <footer>
            <div class="row">
                <div class="columns small-12">
                    Tout droit pas réservés
                </div>
            </div>
        </footer>
    </body>
</html>