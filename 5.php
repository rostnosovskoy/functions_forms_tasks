<!--Написать функцию, которая выводит список файлов в заданной директории,
которые содержат искомое слово.  Директория и искомое слово задаются как
параметры функции.-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="currDirPath">Enter path of diretory:</label>
            <input type="text" name="currDirPath" class="form-control" />
            <label for="userWord">Enter find word:</label>
            <input type="text" name="userWord" class="form-control" />
        </div>
        <button type="submit" class="btn btn-success">Compare</button>
    </form>
    <?php
    echo "<br />";
    if ($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        return;
    }
    $userDir = $_POST['currDirPath'];
    $userWord = $_POST['userWord'];

    listOfFiles($userDir, $userWord);

    ?>
</div>
</body>
</html>

<?php

// ------------------------------- Decision -----------------------------------------

function listOfFiles($pDir, $findWord){
    $res = false;
    if (!is_dir($pDir))
    {
        echo "Unknown (unexist) path! Enter again.";
        exit;
    } elseif ($findWord == "")
    {
        echo "Enter find word!";
        exit;
    } elseif ($ddir = opendir($pDir))
        {
            while (($file = readdir($ddir)) !== false) {
                if (stristr($file, $findWord)) {
                    echo $file . "<br />";
                    if(!$res)
                    $res = true;
                }
            }
            closedir($ddir);
        }
        if (!$res)
            echo "Files didn't find. Change search parametr.";
}
?>

