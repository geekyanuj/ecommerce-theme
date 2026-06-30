import "./toast.js";

/* ===== AUTH ===== */
function handleLogin() {
  const email = document.getElementById("l-email").value.trim();
  const password = document.getElementById("l-pass").value;

  if (!email || !password) {
    showToast("Please fill all fields.");
    return;
  }

  fetch(anneo.ajax_url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "anneo_login",
      nonce: anneo.nonce,
      email: email,
      password: password,
    }),
  })
    .then((r) => r.json())
    .then((res) => {
      showToast(res.data.message);

      if (res.success) {
        setTimeout(() => {
          location.reload();
        }, 800);
      }
    });
}

function handleSignup() {
  const name = document.getElementById("s-name").value.trim();
  const email = document.getElementById("s-email").value.trim();
  const password = document.getElementById("s-pass").value;
  const confirm = document.getElementById("s-confirm-pass").value;

  if (!name || !email || !password || !confirm) {
    showToast("Please fill all fields.");
    return;
  }

  if (password !== confirm) {
    showToast("Passwords do not match.");
    return;
  }

  fetch(anneo.ajax_url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "anneo_signup",
      nonce: anneo.nonce,
      name: name,
      email: email,
      password: password,
    }),
  })
    .then((r) => r.json())
    .then((res) => {
      showToast(res.data.message);

      if (res.success) {
        setTimeout(() => {
          location.reload();
        }, 800);
      }
    });
}

document.getElementById("login-submit").addEventListener("click", handleLogin);

document.getElementById("signup-submit").addEventListener("click", handleSignup);
