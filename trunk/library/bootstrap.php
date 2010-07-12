<?php

// Paths
define('DS', DIRECTORY_SEPARATOR);
define('LIBRARY_PATH', __DIR__);
define('ROOT_PATH', dirname(LIBRARY_PATH));
define('CLASS_PATH', LIBRARY_PATH . '/classes');

// Includes
include LIBRARY_PATH . '/constants.php';
include LIBRARY_PATH . '/functions.php';
include LIBRARY_PATH . '/classes.php';
