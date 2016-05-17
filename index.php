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
    <script type="text/javascript" src="/resources/js/main.js"></script>
</head>
<body>

</body>
</html>