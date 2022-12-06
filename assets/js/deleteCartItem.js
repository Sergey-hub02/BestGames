// удаление товаров из корзины
const orderDelete = document.querySelectorAll(".order-delete");

orderDelete.forEach(btn => {
  btn.addEventListener("click", function (event) {
    event.preventDefault();

    let productId;
    let field;
    let key;

    if (this.hasAttribute("data-console-id")) {
      productId = this.getAttribute("data-console-id");
      field = "ordersconsole";
      key = "console";
    }
    else {
      productId = this.getAttribute("data-gamepad-id");
      field = "ordersgamepad";
      key = "gamepad";
    }

    const orders = JSON.parse(localStorage.getItem(field));
    const toDelete = orders.findIndex(order => {
      return order[key][`${key}_id`] === parseInt(productId);
    });

    // уменьшаем счётчик товаров в корзине
    const productsCounter = parseInt(localStorage.getItem("products")) - orders[toDelete]["amount"];
    localStorage.setItem("products", productsCounter.toString());

    // убираем удалённые товары из корзины
    orders.splice(toDelete, 1);
    localStorage.setItem(field, JSON.stringify(orders));

    window.location.reload();
  });
});
