<?php
ob_start();
?>

<div class="modal-field">
    <label>Email</label>
    <input id="l-email" placeholder="Enter your email">
</div>

<div class="modal-field">
    <label>Password</label>
    <input type="password" id="l-pass" placeholder="Enter your password">
</div>

<button id="login-submit" class="modal-btn">
    Login →
</button>

<p class="modal-switch">
    New here?

    <a data-switch="login:signup">
        Create Account
    </a>
</p>

<?php

$content = ob_get_clean();

get_template_part(
    'template-parts/modals/modal',
    null,
    [
        'id' => 'login',
        'title' => '👋 Welcome Back',
        'content' => $content,
    ]
);