<?php
    require "../utils/Input.php";
    require "../models/Ad.php";
    require_once "../db_connect.php";
    require_once "../views/partials/navbar.php";
    require_once "../views/partials/footer.php";
    if (!empty($_POST))
    {
        $adUp = new Ad();
        foreach ($_POST as $key => $value)
        {
            echo $key.PHP_EOL;
            if ($key != 'uploadImage')
            {
            $adUp->$key = $value;
            }
        }
        foreach ($_FILES as $key => $value)
        {
            if ($_FILES[$key]['name'] !== '')
            {
                print_r($_FILES);
                Input::getImage($_FILES[$key]);
                echo $key;
                $directory = "img/uploads/ads/";
                $targetImage = $directory . basename($_FILES[$key]['name']);
                $adUp->$key = $targetImage;
            }
        }
        $adUp->saveold($dbc);
        header("Location: /ads.show.php?itemid=".$_POST['id']);
    }
    $adUpd = new Ad();
    $lazyAd = $adUpd->findbyid($_GET['itemid'], $dbc);
    foreach ($lazyAd as $key => $value) {
        echo $value;
    }
    if(!$_SESSION["is_logged_in"])
    {
        header("Location: /ads.index.php");
    }
$footer = new Footer();
$footer->userControls($_SESSION['user']);
?>
<html>
<head>
	<title>Create a Listing!</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/list.css">
    <link rel="stylesheet" href=<?= $cssnav ?>>
    <link rel="stylesheet" href=<?= $footer->footcss ?>>
</head>
<body>
    <?= $contentnav ?>
	<main>
        <div id="loginmargin" class="mainadscontainer">
            <div class='adcontainerfail font1'>
            	<form class="formcontainer" method="POST" enctype="multipart/form-data" action="/ads.edit.php">
                        <input class="font1 fontmidsmall" type="hidden" name="id" value=<?= $_GET['itemid'] ?>>
                        <input class="font1 fontmidsmall" type="hidden" name="user" value=<?= $_SESSION['user'] ?>>
                        <?php
                        foreach ($lazyAd as $key => $value) {
                            if ($key !== "user" && $key !== "id")
                            {
                                if($key == "description")
                                {
                                    echo '<textarea id="'.$key.'" class="font1 fontmidsmall" type="text" name="'.$key.'" placeholder="'.$key.'">'.$value.'</textarea>';
                                }
                                elseif(strpos($key, "url") <= 0)
                                {
                                    echo '<input id="'.$key.'" class="font1 fontmidsmall" type="text" name="'.$key.'" placeholder="name" value="'.$value.'">';
                                }
                                elseif (!is_null($value))
                                {
                                    echo '<input type="file" class="imginput font1 fontmidsmall" name='.$key.' value="'.$value.'"">';
                                }
                                else
                                {
                                    echo '<input type="file" class="imginput font1 fontmidsmall" name="'.$key.'">';
                                }
                            }
                        }
                        ?>
                     	<input type="submit" class="button font1 fontmidsmall">
                </form>
            </div>
        </div>
    </main>
    <?= $footer->getFooter() ?>
    <script src="/js/jquery-1.12.0.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
</body>
</html>