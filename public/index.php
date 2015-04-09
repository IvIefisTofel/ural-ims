<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the admin root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the admin!
Zend\Mvc\Application::init(Symfony\Component\Yaml\Yaml::parse(file_get_contents('config/application.config.yaml')))->run();
//Zend\Mvc\Application::init(include 'config/admin.config.php')->run();