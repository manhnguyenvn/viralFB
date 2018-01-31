<?php

class Errors
{
    public static $errors = array();
}

$checks = array();
define('MIN_PHP_VERSION', 5.4);

function check($name, $callback)
{
    global $checks;
    $checks[] = $name;
    call_user_func($callback);
}

check("Need PHP version >=" . MIN_PHP_VERSION, function () {
    if (!version_compare(phpversion(), MIN_PHP_VERSION, '>=')) {
        Errors::$errors[] = array(
            'title' => 'PHP version error',
            'message' => "Laravel requires a minimum PHP version of " . MIN_PHP_VERSION . '<br>' . "Your current PHP version " . phpversion() . " is not supported."
        );
    }
});

check("Mcrypt Extension is required", function () {
    if (!extension_loaded('mcrypt')) {
        Errors::$errors[] = array(
            'title' => "MCrypt Extension not loaded",
            'message' => "Laravel requires MCrypt PHP Extension"
        );
    }
});

check("OpenSSL Extension is required", function () {
    if (!extension_loaded('openssl')) {
        Errors::$errors[] = array(
            'title' => "OpenSSL Extension not loaded",
            'message' => "Laravel requires OpenSSL PHP Extension"
        );
    }
});

check("PDO Extension is required", function () {
    if (!extension_loaded('pdo')) {
        Errors::$errors[] = array(
            'title' => "PDO Extension not loaded",
            'message' => "ViralFB requires PDO PHP Extension for Database connections"
        );
    }
});

check("MbString Extension is required", function () {
    if (!extension_loaded('mbstring')) {
        Errors::$errors[] = array(
            'title' => "MbString Extension not loaded",
            'message' => "ViralFB requires MbString PHP Extension"
        );
    }
});

check("GD Library Extension is required", function () {
    if (!extension_loaded('gd')) {
        Errors::$errors[] = array(
            'title' => "GD Library Extension not loaded",
            'message' => "ViralFB requires GD Library PHP Extension for Image processing"
        );
    }
});

check("JSON module required", function () {
    if (!function_exists('json_encode')) {
        Errors::$errors[] = array(
            'title' => "PHP JSON not available",
            'message' => "PHP JSON should be enabled as we require json_encode and similar functions."
        );
    }
});

check("'storage' directory should be writable", function () {
    $storageFilePath = __DIR__ . '/local/storage';
    if (!is_writable($storageFilePath)) {
        Errors::$errors[] = array(
            'title' => "'storage' directory should be writable",
            'message' => "Make '" . $storageFilePath . "' directory writable by assigning appropriate permissions.<br>( For eg, via shell command: chmod -R 777 " . $storageFilePath . " )"
        );
    }
});

check("'vendor' directory should be writable", function () {
    $storageFilePath = __DIR__ . '/local/vendor';
    if (!is_writable($storageFilePath)) {
        Errors::$errors[] = array(
            'title' => "'vendor' directory should be writable",
            'message' => "Make '" . $storageFilePath . "' directory writable by assigning appropriate permissions.<br>( For eg, via shell command: chmod -R 777 " . $storageFilePath . " )"
        );
    }
});

error_reporting(0);
chmod("local/storage/app", 0775);
chmod("local/storage/framework", 0775);
chmod("local/storage/logs", 0775);
chmod("local/vendor", 0775);
if (empty(Errors::$errors)) {
    header("Location: install");
    exit();
}

?>


<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Minimum requirements</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>
    <style>
        body {
            background-image: url("installer/img/background.png");
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" id="mainColumn">


            <?php
            if (!empty(Errors::$errors)) {
                ?>
                <div class="text-center" style="color: #fff; margin: 40px 0px;"><h1>Sorry! You are missing some
                        requirements</h1></div><br/>
                <?php
                foreach (Errors::$errors as $error) {
                    ?>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <b><?php echo $error['title'] ?></b>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php echo $error['message'] ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="text-center" style="color: #fff; margin: 30px 0px;">
                    Contact your hosting provider to fix them or move to a different host that meets these requirements.
                </div>
                <?php
            }

            ?>
        </div>
    </div>
</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

</body>
</html>