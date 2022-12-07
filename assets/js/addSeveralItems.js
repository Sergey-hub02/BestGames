const cartButton = document.querySelector(".cart-btn");
const cartCounter = document.querySelector("#cart-counter");

// отображаем количество товаров в корзине
cartCounter.textContent = (localStorage.hasOwnProperty("products"))
  ? localStorage.getItem("products")
  : "0";

cartButton.addEventListener("click", function (event) {
  event.preventDefault();

  const product = JSON.parse(this.getAttribute("data-object"));
  const productAmount = parseInt(document.querySelector("#inputQuantity").value);

  console.log(cartCounter.textContent);
  const countProducts = (parseInt(cartCounter.textContent) + productAmount).toString();
  console.log(countProducts);

  // увеличиваем количество товаров в корзине
  localStorage.setItem("products", countProducts);
  cartCounter.textContent = countProducts;

  // определяем тип товара
  let prop;
  let key;

  if (product.hasOwnProperty("console_id")) {
    prop = "ordersconsole";
    key = "console";
  }
  else {
    prop = "ordersgamepad";
    key = "gamepad";
  }

  // добавляем товар в корзину
  if (!localStorage.hasOwnProperty(prop)) {
    localStorage.setItem(
      prop,
      JSON.stringify([{
        [key]: product,
        amount: productAmount
      }])
    );
    return;
  }

  // получаем товары
  const orders = JSON.parse(localStorage.getItem(prop));
  const predicate = order => order[key][`${key}_id`] === product[`${key}_id`];

  const result = orders.find(predicate);
  if (result === undefined) {
    // если такого товара в корзине не было, то добавляем его
    orders.push({
      [key]: product,
      amount: productAmount
    });
  }
  else {
    // если такой товар в корзине был, то просто увеличиваем поле количества товара
    result["amount"] += productAmount;
  }

  localStorage.setItem(prop, JSON.stringify(orders));
});
