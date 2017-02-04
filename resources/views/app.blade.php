<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} - @yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="css/app.css" rel="stylesheet" type="text/css">
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div id="app">

            <section class="hero is-dark">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">Fake coffee shop</h1>
                        <h2 class="subtitle">There is no coffee here. But there is some knowledge.</h2>
                    </div>
                </div>
            </section>
            <header class="nav">
                <div class="container">
                    <span class="nav-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="nav-right nav-menu">
                        <span class="nav-item">
                            <a href="/cart" class="button">
                                <img class="image is-32x32" src="image/shopping-cart.svg"/>
                                <span class="content is-medium">&emsp;0</span>
                            </a>
                        </span>
                    </div>
                </div>
            </header>
            <section class="section">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </div>
        <script src="js/app.js"></script>
    </body>
</html>