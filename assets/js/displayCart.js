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
                type="text"
                class="form-control text-center"
                style="width: 4rem"
                value="${item['amount']}"
                min="1"
                readonly
              >
            </div>

            <div class="mx-4">
              <h5 class="mb-0">$${item['console']['price'] * item['amount']}</h5>
            </div>

            <button
              type="button"
              data-console-id="${item['console']['console_id']}"
              class="btn btn-danger order-delete"
              name="delete"
            >
              <i class="fa-solid fa-trash"></i>
            </button>
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
              type="text"
              class="form-control text-center"
              style="width: 4rem"
              value="${item['amount']}"
              min="1"
              readonly
            >
          </div>

          <div class="mx-4">
            <h5 class="mb-0">$${item['gamepad']['price'] * item['amount']}</h5>
          </div>

          <button
            type="button"
            data-gamepad-id="${item['gamepad']['gamepad_id']}"
            class="btn btn-danger order-delete"
            name="delete"
          >
            <i class="fa-solid fa-trash"></i>
          </button>
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
const cartCounter = document.querySelector("#cart-counter");

// отображаем количество товаров в корзине
cartCounter.textContent = (localStorage.hasOwnProperty("products"))
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

// расчёт общей стоимости заказа
const orderCostContainer = document.querySelector("#order-cost");

let cost = ordersConsole.reduce((prev, current) => {
  return prev + current["console"]["price"] * current["amount"];
}, 0);

cost += ordersGamepad.reduce((prev, current) => {
  return prev + current["gamepad"]["price"] * current["amount"];
}, 0);

orderCostContainer.innerHTML = `$${cost}`;
