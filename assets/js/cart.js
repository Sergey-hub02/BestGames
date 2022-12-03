const cartButtons = document.querySelectorAll(".cart-btn");
const cartCounter = document.querySelector("#cart-counter");

// отображаем количество товаров в корзине
cartCounter.textContent = (localStorage.hasOwnProperty("products"))
  ? localStorage.getItem("products")
  : "0";

cartButtons.forEach(button => {
  button.addEventListener("click", event => {
    const product = JSON.parse(event.target.getAttribute("data-object"));
    const countProducts = parseInt(cartCounter.textContent) + 1;

    // увеличиваем количество товаров в корзине
    localStorage.setItem("products", countProducts.toString());
    cartCounter.textContent = countProducts.toString();

    // определяем тип товара
    const prop = (product.hasOwnProperty("console_id")) ? "ordersconsole" : "ordersgamepad";
    const key = (prop === "ordersconsole") ? "console" : "gamepad";

    // добавляем товар в корзину
    if (!localStorage.hasOwnProperty(prop)) {
      localStorage.setItem(
        prop,
        JSON.stringify([{
          [key]: product,
          amount: 1
        }])
      );
      return;
    }

    // получаем товары
    const orders = JSON.parse(localStorage.getItem(prop));
    const predicate = (prop === "ordersconsole")
      ? order => order["console"]["console_id"] === product["console_id"]
      : order => order["gamepad"]["gamepad_id"] === product["gamepad_id"];

    const result = orders.find(predicate);
    if (result === undefined) {
      // если такого товара в корзине не было, то добавляем его
      orders.push({
        [key]: product,
        amount: 1
      });
    }
    else {
      // если такой товар в корзине был, то просто увеличиваем поле количества товара
      ++result["amount"];
    }

    localStorage.setItem(prop, JSON.stringify(orders));
  });
});
