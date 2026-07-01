let tt;
export function showToast(msg, type = "success") {
  const t = document.getElementById("toast");

  t.textContent = msg;

  t.classList.remove("show-success", "show-error", "show-warning");
  t.classList.add(`show-${type}`);

  clearTimeout(tt);

  tt = setTimeout(() => {
    t.classList.remove("show-success", "show-error", "show-warning");
  }, 3200);
}

function focusField(id, message) {
  const el = document.getElementById(id);

  if (!el) return;

  el.focus();
  el.classList.add("input-error");

  showToast(message, "error");

  setTimeout(() => {
    el.classList.remove("input-error");
  }, 3000);
}

/* ===== AUTH ===== */
function handleLogin() {
  const email = document.getElementById("l-email").value.trim();
  const password = document.getElementById("l-pass").value;

  if (!email) {
    focusField("l-email", "Please enter your email address.");
    return;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailRegex.test(email)) {
    focusField("l-email", "Please enter a valid email address.");
    return;
  }

  if (!password) {
    focusField("l-pass", "Please enter your password.");
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
      email,
      password,
    }),
  })
    .then((r) => r.json())
    .then((res) => {
      showToast(res.data.message, res.success ? "success" : "error");

      if (res.success) {
        setTimeout(() => location.reload(), 800);
      }
    })
    .catch(() => {
      showToast("Something went wrong. Please try again.", "error");
    });
}

function handleSignup() {
  const name = document.getElementById("s-name").value.trim();
  const email = document.getElementById("s-email").value.trim();
  const password = document.getElementById("s-pass").value;
  const confirm = document.getElementById("s-confirm-pass").value;

  if (!name) {
    focusField("s-name", "Please enter your full name.");
    return;
  }

  if (name.length < 3) {
    focusField("s-name", "Name must be at least 3 characters.");
    return;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!email) {
    focusField("s-email", "Please enter your email address.");
    return;
  }

  if (!emailRegex.test(email)) {
    focusField("s-email", "Please enter a valid email address.");
    return;
  }

  if (!password) {
    focusField("s-pass", "Please enter a password.");
    return;
  }

  if (password.length < 8) {
    focusField("s-pass", "Password must be at least 8 characters.");
    return;
  }

  if (!/[A-Z]/.test(password)) {
    focusField("s-pass", "Password must contain at least one uppercase letter.");
    return;
  }

  if (!/[a-z]/.test(password)) {
    focusField("s-pass", "Password must contain at least one lowercase letter.");
    return;
  }

  if (!/[0-9]/.test(password)) {
    focusField("s-pass", "Password must contain at least one number.");
    return;
  }

  if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
    focusField("s-pass", "Password must contain at least one special character.");
    return;
  }

  if (password !== confirm) {
    focusField("s-confirm-pass", "Passwords do not match.");
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
      name,
      email,
      password,
    }),
  })
    .then((r) => r.json())
    .then((res) => {
      showToast(res.data.message, res.success ? "success" : "error");

      if (res.success) {
        setTimeout(() => location.reload(), 800);
      }
    })
    .catch(() => {
      showToast("Something went wrong. Please try again.", "error");
    });
}

document.getElementById("login-submit").addEventListener("click", handleLogin);

document
  .getElementById("signup-submit")
  .addEventListener("click", handleSignup);
