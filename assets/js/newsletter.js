function handleContactForm() {
  showToast("Message sent! We will reply shortly 📨");
}
function handleNewsletter() {
  const e = document.getElementById("nl-email").value.trim();
  if (!e) {
    showToast("Please enter your email ⚠️");
    return;
  }
  showToast("Subscribed! Stay Fresh 🌿");
  document.getElementById("nl-email").value = "";
}
