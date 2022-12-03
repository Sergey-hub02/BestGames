<?php
$consoles = json_decode(
  file_get_contents("http://localhost/api/index.php/console/list"),
  true
);

$wiredGamepads = json_decode(
  file_get_contents("http://localhost/api/index.php/wiredgamepad/list"),
  true
);

$wirelessGamepads = json_decode(
  file_get_contents("http://localhost/api/index.php/wirelessgamepad/list"),
  true
);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Главная</title>

  <link rel="icon" type="image/x-icon" href="/assets/images/icons/BestGames_16x16.ico">
  <link rel="stylesheet" href="/libs/bootstrap-5.2.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/libs/fontawesome-free-6.2.1-web/css/fontawesome.min.css">
  <link rel="stylesheet" href="/libs/fontawesome-free-6.2.1-web/css/solid.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>


<body>

<!--========== HEADER =========-->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
  <div class="container px-4 px-lg-5">
    <a class="navbar-brand d-inline-flex align-items-center" href="/">
      <img
        class="icon"
        src="/assets/images/icons/BestGames_48x48.png"
        alt="Logo"
      >
      <span class="ps-2">BestGames</span>
    </a>

    <form class="d-flex">
      <button class="btn btn-outline-dark" type="submit">
        <i class="fa-solid fa-cart-shopping"></i>
        Корзина
        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
      </button>
    </form>
  </div>
</nav>

<!--========== BANNER ==========-->
<header class="bg-dark py-5 banner">
  <div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-white">
      <h1 class="display-4 fw-bolder banner-title">Best Games</h1>
      <p class="lead fw-normal mb-0 banner-text">Магазин игровых консолей</p>
    </div>
  </div>
</header>

<!--========== КОНСОЛИ ==========-->
<section class="py-4">
  <div class="container px-4 px-lg-5">
    <h3 class="mb-3">Игровые консоли</h3>

    <div class="row row-cols-3">

      <?php foreach ($consoles as $console): ?>
        <div class="col mb-5" data-object='<?= json_encode($console, JSON_UNESCAPED_UNICODE) ?>'>
          <div class="card h-100">
            <!-- Изображение товара -->
            <a href="/pages/console.php?id=<?= $console['console_id'] ?>">
              <div class="card-background" style="background-image: url(<?= $console['image'] ?>)"></div>
            </a>

            <!-- Детали товара -->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Название товара -->
                <a class="text-decoration-none" href="/pages/console.php?id=<?= $console['console_id'] ?>">
                  <h5 class="fw-bolder text-dark"><?= $console["name"] ?></h5>
                </a>

                <!-- Характеристики -->
                <div class="text-start mb-2">
                  <div class="product-prop">
                    <strong>Производитель:&nbsp;</strong>
                    <?= $console["brand"] ?>
                  </div>

                  <div class="product-prop">
                    <strong>Видеокарта:&nbsp;</strong>
                    <?= $console["gpu"] ?>
                  </div>

                  <div class="product-prop">
                    <strong>Процессор:&nbsp;</strong>
                    <?= $console["cpu"] ?>
                  </div>

                  <div class="product-prop">
                    <strong>Объём ОЗУ:&nbsp;</strong>
                    <?= $console["ram"] ?>&nbsp;Мб
                  </div>

                  <div class="product-prop">
                    <strong>Цена:&nbsp;</strong>
                    $<?= $console["price"] ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Добавить корзину</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>

    </div>
  </div>
</section>

<!--========== ПРОВОДНЫЕ ГЕЙМПАДЫ ==========-->
<section class="py-4">
  <div class="container px-4 px-lg-5">
    <h3 class="mb-3">Проводные геймпады</h3>

    <div class="row row-cols-3">

      <?php foreach ($wiredGamepads as $gamepad): ?>
        <div class="col mb-5" data-object='<?= json_encode($gamepad, JSON_UNESCAPED_UNICODE) ?>'>
          <div class="card h-100">
            <!-- Изображение товара -->
            <a href="/pages/wired.php?id=<?= $gamepad['gamepad_id'] ?>">
              <div class="card-background" style="background-image: url(<?= $gamepad['image'] ?>)"></div>
            </a>

            <!-- Детали товара -->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Название товара -->
                <a class="text-decoration-none" href="/pages/wired.php?id=<?= $gamepad['gamepad_id'] ?>">
                  <h5 class="fw-bolder text-dark"><?= $gamepad["name"] ?></h5>
                </a>

                <!-- Характеристики -->
                <div class="text-start mb-2">
                  <div class="product-prop">
                    <strong>Производитель:&nbsp;</strong>
                    <?= $gamepad["brand"] ?>
                  </div>

                  <div class="product-prop">
                    <strong>Количество кнопок:&nbsp;</strong>
                    <?= $gamepad["buttons"] ?>
                  </div>

                  <div class="product-prop">
                    <strong>Длина провода:&nbsp;</strong>
                    <?= $gamepad["cabel_length"] ?> м
                  </div>

                  <div class="product-prop">
                    <strong>Энергопотребление:&nbsp;</strong>
                    <?= $gamepad["consumption"] ?>&nbsp;
                  </div>

                  <div class="product-prop">
                    <strong>Цена:&nbsp;</strong>
                    $<?= $gamepad["price"] ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Добавить корзину</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>

    </div>
  </div>
</section>

<!--========== БЕСПРОВОДНЫЕ ГЕЙМПАДЫ ==========-->
<section class="py-4">
  <div class="container px-4 px-lg-5">
    <h3 class="mb-3">Беспроводные геймпады</h3>

    <div class="row row-cols-3">

      <?php foreach ($wirelessGamepads as $gamepad): ?>
        <div class="col mb-5" data-object='<?= json_encode($gamepad, JSON_UNESCAPED_UNICODE) ?>'>
          <div class="card h-100">
            <!-- Изображение товара -->
            <a href="/pages/wireless.php?id=<?= $gamepad['gamepad_id'] ?>">
              <div class="card-background" style="background-image: url(<?= $gamepad['image'] ?>)"></div>
            </a>

            <!-- Детали товара -->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Название товара -->
                <a class="text-decoration-none" href="/pages/wireless.php?id=<?= $gamepad['gamepad_id'] ?>">
                  <h5 class="fw-bolder text-dark"><?= $gamepad["name"] ?></h5>
                </a>

                <!-- Характеристики -->
                <div class="text-start mb-2">
                  <div class="product-prop">
                    <strong>Производитель:&nbsp;</strong>
                    <?= $gamepad["brand"] ?>
                  </div>

                  <div class="product-prop">
                    <strong>Количество кнопок:&nbsp;</strong>
                    <?= $gamepad["buttons"] ?>&nbsp;
                  </div>

                  <div class="product-prop">
                    <strong>Ёмкость аккумулятора:&nbsp;</strong>
                    <?= $gamepad["capacity"] ?>
                  </div>

                  <div class="product-prop">
                    <strong>Частота:&nbsp;</strong>
                    <?= $gamepad["frequency"] ?> Гц
                  </div>

                  <div class="product-prop">
                    <strong>Цена:&nbsp;</strong>
                    $<?= $gamepad["price"] ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Добавить корзину</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>

    </div>
  </div>
</section>

<!--========= FOOTER ==========-->
<footer class="py-5 bg-dark text-white text-center">
  <div class="container">
    <a class="navbar-brand d-inline-flex align-items-center" href="/">
      <img
        class="icon"
        src="/assets/images/icons/BestGames_48x48.png"
        alt="Logo"
      >
      <h3 class="ps-2 mb-0">BestGames</h3>
    </a>

    <address class="my-1">г. Москва, Проспект Вернадского, д. 78</address>

    <p class="m-0">
      Контактный телефон:&nbsp;
      <a href="tel:+74992156565">+7 (499) 215-65-65</a>
    </p>

    <p class="m-0">&copy; Все права защищены BestGames</p>
  </div>
</footer>

<script src="/libs/bootstrap-5.2.3-dist/js/bootstrap.min.js"></script>

</body>

</html>
