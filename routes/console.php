<?php

use App\Console\Commands\MakeRepository;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('make:repository {name}', function ($name) {
    $this->call(MakeRepository::class, ['name' => $name]);
})->purpose('Create a new repository class');