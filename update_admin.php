<?php

use Illuminate\Database\Capsule\Manager as DB;

// Load Laravel
$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->handle(
    $request = \Illuminate\Http\Request::capture()
);

// Update admin user
\DB::table('users')
    ->where('email', 'admin@gmail.com')
    ->update(['role' => 'admin']);

echo "✓ User admin@gmail.com sudah diupdate dengan role admin!\n";
