<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . \DIRECTORY_SEPARATOR . 'fixtures');

require TEST_BASE_PATH . '/_container.php';