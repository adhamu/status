<?php
    require __DIR__ . '/vendor/autoload.php';
    $app = new Status\Container;

    echo '<pre>';
    print_r( $app->get()->getEnv() );
    echo '</pre>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Status</title>
</head>
<body>

</body>
</html>