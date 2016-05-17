<?php
    require __DIR__ . '/vendor/autoload.php';
    $app = (new Status\Container)->get();

    echo '<pre>';
    print_r( $app->getEnv() );
    echo '</pre>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Status</title>
</head>
<body>

    <script type="text/javascript" src="/resources/js/main.js"></script>
</body>
</html>