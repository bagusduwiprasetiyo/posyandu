<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Cek id posyandu Rambipuji
$r = DB::table('list_posyandu')->where('nama', 'like', '%Rambipuji%')->orWhere('nama', 'like', '%rambipuji%')->get();
echo json_encode($r, JSON_PRETTY_PRINT);

// Cek apakah kolom sudah ada
$cols = DB::select("SHOW COLUMNS FROM list_posyandu");
foreach ($cols as $c) echo $c->Field . "\n";
