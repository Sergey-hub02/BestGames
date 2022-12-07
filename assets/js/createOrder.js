const formDataToJSON = formData => {
  let object = {};

  formData.forEach((value, key) => {
    object[key] = value;
  });

  return JSON.stringify(object);
}


const orderForm = document.querySelector("#order-form");

orderForm.addEventListener("submit", async event => {
  event.preventDefault();

  const formData = new FormData(orderForm);
  const client = JSON.parse(formDataToJSON(formData));

  let jsonData = {};

  jsonData["client"] = client;
  jsonData["ordersconsole"] = JSON.parse(localStorage.getItem("ordersconsole"));
  jsonData["ordersgamepad"] = JSON.parse(localStorage.getItem("ordersgamepad"));

  let cost = ordersConsole.reduce((prev, current) => {
    return prev + current["console"]["price"] * current["amount"];
  }, 0);

  cost += ordersGamepad.reduce((prev, current) => {
    return prev + current["gamepad"]["price"] * current["amount"];
  }, 0);

  jsonData["price"] = cost;

  const request = new XMLHttpRequest();
  request.responseType = "json";

  request.open("POST", "/scripts/createOrder.php");
  request.send(JSON.stringify(jsonData));

  request.onload = () => {
    const response = request.response;

    if (response && request.status === 201) {
      // очищаем корзину, форму и перезагружаем страницу
      localStorage.setItem("ordersconsole", "[]");
      localStorage.setItem("ordersgamepad", "[]");
      localStorage.setItem("products", "0");

      orderForm.reset();
      window.location.reload();
    }
  }
});
