function saveOrder(order) {
  try {
    const orders = JSON.parse(localStorage.getItem("anneo_orders") || "[]");
    orders.push(order);
    localStorage.setItem("anneo_orders", JSON.stringify(orders));
  } catch (e) {}
}