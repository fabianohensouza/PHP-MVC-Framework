<?php

/** User: FHS Dev...  */

    use app\controllers\SiteController;
    use app\controllers\AuthController;
    use app\core\Application;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__.'/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $config = [
        'db' => [
            'dsn' => $_ENV['DB_DSN'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD']
        ]
    ];

    $app = new Application(__DIR__, $config);

    $app->db->applyMigrations();

?>
