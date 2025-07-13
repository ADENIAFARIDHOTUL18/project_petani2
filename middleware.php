<?php
function start_session_if_not_started() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function auth_required() {
    start_session_if_not_started();
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=login");
        exit;
    }
}

function guest_only() {
    start_session_if_not_started();
    if (isset($_SESSION['user'])) {
        header("Location: index.php?page=dashboard");
        exit;
    }
}
