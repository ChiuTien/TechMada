<?php
$writable = __DIR__ . '/../writable/base.db';
$sqlFile  = __DIR__ . '/../app/Database/Sql/Schema/Table.sqlite.sql';

if (!is_dir(dirname($writable))) {
    mkdir(dirname($writable), 0777, true);
}

if (!file_exists($writable)) {
    touch($writable);
}

try {
    $pdo = new PDO('sqlite:' . $writable);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('PRAGMA foreign_keys = ON;');

    $sql = file_get_contents($sqlFile);
    if ($sql === false) {
        throw new Exception('SQL file not found: ' . $sqlFile);
    }

    $pdo->exec($sql);
    echo "Imported SQL into {$writable}\n";
} catch (Throwable $e) {
    fwrite(STDERR, "Error importing SQL: " . $e->getMessage() . "\n");
    exit(1);
}
