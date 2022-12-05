/**
 * Необходимо вывести все товары из корзины, данные которой
 * хранятся в localStorage
 */

/**
 * Возвращает html-код товара корзины
 * @param item
 */
const createCartItem = item => {
  if (item.hasOwnProperty("console")) {
    return `
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="d-flex flex-row align-items-center">
            <div>
              <img
                src="${item['console']['image']}"
                class="img-fluid rounded-3"
                alt="${item['console']['name']}"
                style="width: 65px;"
              >
            </div>

            <div class="ms-3">
              <h5>${item['console']['name']}</h5>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center">
            <div>
              <input
                type="number"
                class="form-control text-center"
                style="width: 4rem"
                value="${item['amount']}"
                min="1"
              >
            </div>

            <div class="mx-4">
              <h5 class="mb-0">$${item['console']['price']}</h5>
            </div>

            <form action="/">
              <button
                type="submit"
                class="btn btn-danger"
                name="delete"
              >
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    `;
  }

  return `
  <div class="card mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <div class="d-flex flex-row align-items-center">
          <div>
            <img
              src="${item['gamepad']['image']}"
              class="img-fluid rounded-3"
              alt="${item['gamepad']['name']}"
              style="width: 65px;"
            >
          </div>

          <div class="ms-3">
            <h5>${item['gamepad']['name']}</h5>
          </div>
        </div>

        <div class="d-flex flex-row align-items-center">
          <div>
            <input
              type="number"
              class="form-control text-center"
              style="width: 4rem"
              value="${item['amount']}"
              min="1"
            >
          </div>

          <div class="mx-4">
            <h5 class="mb-0">$${item['gamepad']['price']}</h5>
          </div>

          <form action="/">
            <button
              type="submit"
              class="btn btn-danger"
              name="delete"
            >
              <i class="fa-solid fa-trash"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  `;
}


/**
 * Объединяет товары корзины в html-код
 * @param prev
 * @param current
 */
const assembleItems = (prev, current) => {
  return `
  ${prev}
  ${createCartItem(current)}
  `;
}

/* ОТОБРАЖЕНИЕ КОЛИЧЕСТВА ТОВАРОВ В КОРЗИНЕ */
const productsCount = document.querySelector("#products-counter");
productsCount.textContent = (localStorage.hasOwnProperty("products"))
  ? localStorage.getItem("products")
  : "0";

/* ОТОБРАЖЕНИЕ ТОВАРОВ */
const cart = document.querySelector("#cart-container");

// получение консолей
const ordersConsole = JSON.parse(localStorage.getItem("ordersconsole"));
const ordersGamepad = JSON.parse(localStorage.getItem("ordersgamepad"));

const consoles = ordersConsole.reduce(assembleItems, "");
const gamepads = ordersGamepad.reduce(assembleItems, "");

cart.innerHTML = `${consoles}\n${gamepads}`;
