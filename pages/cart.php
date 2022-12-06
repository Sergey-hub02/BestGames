<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Корзина</title>

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

<!--========== КОРЗИНА ==========-->
<section class="h-100 h-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <!-- Содержимое корзины -->
              <div class="col-lg-7" id="cart-container">
              </div>

              <div class="col-lg-5">
                <div class="card bg-dark text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Детали заказа</h5>
                    </div>

                    <form class="mt-4" action="/" method="post">
                      <div class="form-outline form-white mb-4">
                        <input
                          type="text"
                          id="first_name"
                          name="first_name"
                          class="form-control"
                          size="17"
                          placeholder="Имя"
                        >
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input
                          type="text"
                          id="last_name"
                          name="last_name"
                          class="form-control"
                          size="17"
                          placeholder="Фамилия"
                        >
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input
                          type="email"
                          id="email"
                          name="email"
                          class="form-control"
                          size="17"
                          placeholder="E-mail"
                        >
                      </div>

                      <h5>Адрес</h5>

                      <div class="form-outline form-white mb-4">
                        <input
                          type="text"
                          id="region"
                          name="region"
                          class="form-control"
                          size="17"
                          placeholder="Область"
                        >
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input
                          type="text"
                          id="city"
                          name="city"
                          class="form-control"
                          size="17"
                          placeholder="Город"
                        >
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input
                          type="text"
                          id="street"
                          name="street"
                          class="form-control"
                          size="17"
                          placeholder="Улица"
                        >
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input
                          type="text"
                          id="house"
                          name="house"
                          class="form-control"
                          size="17"
                          placeholder="Дом"
                        >
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input
                          type="text"
                          id="flat"
                          name="flat"
                          class="form-control"
                          size="17"
                          placeholder="Квартира"
                        >
                      </div>
                    </form>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">К оплате</p>
                      <p class="mb-2">$4798.00</p>
                    </div>

                    <div class="text-center">
                      <button
                        type="submit"
                        class="btn btn-outline-warning"
                        name="pay"
                      >
                        Оплатить
                      </button>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
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
<script src="/assets/js/displayCart.js"></script>
<script src="/assets/js/deleteCartItem.js"></script>

</body>

</html>
