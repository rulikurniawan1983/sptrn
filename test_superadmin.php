<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::find(1);
echo "Email: " . $user->email . "\n";
echo "Current Role ID: " . $user->current_role_id . "\n";

$hasSuperAdmin = \App\Models\UsersRole::where('users_id', $user->id)
    ->whereIn('role_id', [11])
    ->whereHas('role', function ($q) {
        $q->whereIn('name', ['Super Admin']);
    })
    ->exists();

echo "Has Super Admin Role: " . ($hasSuperAdmin ? 'Yes' : 'No') . "\n";
echo "Gate Check Dashboard Show: " . ($user->can('Dashboard Show') ? 'Allowed' : 'Denied') . "\n";
