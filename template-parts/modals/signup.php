<?php
ob_start();
?>

<div class="modal-field">
    <label>Full Name</label>
    <input id="s-name" placeholder="Enter your full name">
</div>

<div class="modal-field">
    <label>Email</label>
    <input id="s-email" placeholder="Enter your email">
</div>

<div class="modal-field">
    <label>Password</label>
    <input type="password" id="s-pass" placeholder="Enter your password">
</div>

<div class="modal-field">
    <label>Confirm Password</label>
    <input type="password" id="s-confirm-pass" placeholder="Confirm your password">
</div>

<button id="signup-submit" class="modal-btn">
    Sign Up
</button>

<p class="modal-switch">
    Already have an account?

    <a href="#" data-switch="signup:login">
        Login
    </a>
</p>

<?php

$content = ob_get_clean();

get_template_part(
    'template-parts/modals/modal',
    null,
    [
        'id' => 'signup',
        'title' => '🌿 Join ANNEO Fresh',
        'content' => $content,
    ]
);