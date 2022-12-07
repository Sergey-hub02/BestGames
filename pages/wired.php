<?php
if (
  empty($_REQUEST["id"])
  || !is_numeric($_REQUEST["id"])
  || str_contains($_REQUEST["id"], ".")
  || str_contains($_REQUEST["id"], ",")
  || intval($_REQUEST["id"]) <= 0
) {
  die("Некорректный id проводного геймпада!");
}

$id = intval($_REQUEST["id"]);
$gamepad = json_decode(
  file_get_contents("http://localhost/api/index.php/wiredgamepad/list?id=$id"),
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

  <title><?= $gamepad["name"] ?></title>

  <link rel="icon" type="image/x-icon" href="/assets/images/icons/BestGames_16x16.ico">
  <link rel="stylesheet" href="/libs/bootstrap-5.2.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/libs/fontawesome-free-6.2.1-web/css/fontawesome.min.css">
  <link rel="stylesheet" href="/libs/fontawesome-free-6.2.1-web/css/solid.min.css">
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
        <a class="text-decoration-none" href="/pages/cart.php">Корзина</a>
        <span id="cart-counter" class="badge bg-dark text-white ms-1 rounded-pill">0</span>
      </button>
    </form>
  </div>
</nav>

<!--========== ИНФОРМАЦИЯ О ТОВАРЕ ==========-->
<section class="py-2">
  <div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
      <div class="col-md-6">
        <img
          class="card-img-top mb-5 mb-md-0"
          src="<?= $gamepad['image'] ?>"
          alt="<?= $gamepad['name'] ?>"
        >
      </div>

      <div class="col-md-6">
        <h1 class="display-5 fw-bolder"><?= $gamepad['name'] ?></h1>

        <div class="fs-5">
          <span>$<?= $gamepad['price'] ?></span>
        </div>

        <div class="mb-2">
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

        <div class="d-flex">
          <input
            style="width: 5rem"
            class="form-control text-center me-3"
            id="inputQuantity"
            type="number"
            value="1"
            min="1"
          >

          <button
            class="btn btn-outline-dark flex-shrink-0 cart-btn"
            data-object='<?= json_encode($gamepad, JSON_UNESCAPED_UNICODE) ?>'
            type="button"
          >
            <i class="fa-solid fa-cart-shopping"></i>
            В корзину
          </button>
        </div>
      </div>
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
<script src="/assets/js/addSeveralItems.js"></script>

</body>

</html>
