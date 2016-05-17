<?php
    require __DIR__ . '/vendor/autoload.php';
    $app = (new Status\Container)->get();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Status</title>
    <link rel="stylesheet" href="<?=$app->getStylesheetFilename()?>" type="text/css"/>
</head>
<body>

    <div class="container">
        <header>
            <h1>Status</h1>
        </header>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                One of three columns
            </div>
            <div class="col-sm-4">
                One of three columns
            </div>
            <div class="col-sm-4">
                One of three columns
            </div>
        </div>
        <hr>
        <footer>
            Copyright &copy;
            <?=date("Y")?>
        </footer>
    </div>


    <script type="text/javascript" src="<?=$app->getScriptFilename()?>"></script>
</body>
</html>