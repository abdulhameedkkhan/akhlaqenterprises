<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/products', 'GET', ['category' => '14']);
$request->headers->set('X-Requested-With', 'XMLHttpRequest');
$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
echo "Content: \n" . substr($response->getContent(), 0, 500) . "\n";
