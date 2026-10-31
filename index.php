<?php
/**
 * Clark ATM Management — small front controller.
 * Site content lives in home.html and 404.html.
 * Apache only forwards non-file requests here; PHP owns the routes/statuses.
 */
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = '/' . ltrim(rawurldecode($path), '/');

$redirects = [
    '/index.php' => '/',
    '/index.html' => '/',
    '/home' => '/',
    '/home/' => '/',
    '/contact' => '/#contact',
    '/contact/' => '/#contact',
];

if (array_key_exists($path, $redirects)) {
    header('Location: ' . $redirects[$path], true, 301);
    exit;
}

if ($path === '/') {
    http_response_code(200);
    require __DIR__ . '/home.html';
    exit;
}

http_response_code(404);
require __DIR__ . '/404.html';
