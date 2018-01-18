<!--Есть текстовый файл. Необходимо удалить из него все слова, длина которых
превыщает N символов. Значение N задавать через форму. Проверить работу на
кириллических строках - найти ошибку, найти решение.-->

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
    <form action="3.php" method="post">
        <div class="form-group">
            <label for="num">Enter count symbols:</label>
            <input type="number" name="num" class="form-control"></input>
        </div>
        <button type="submit" class="btn btn-success">Send</button>
    </form>
    <?php
    echo "<br />";
    if ($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        return;
    }
    $num = $_POST['num'];
    deleteWordsFromFile('3.txt', $num);
    ?>
</div>
</body>
</html>

<?php

function deleteWordsFromFile($fileTxt = '3.txt', $countSymbols)
{
    mb_internal_encoding("UTF-8"); // install internal charset of script

    // -----------------------Open file for reading and read------------------------------------------

    $df = fopen($fileTxt, 'r');
    if (!$df)
    {
        echo "Erorr open file! Try again.";
    }
    flock($df, 1);
    $fStr = fread($df, filesize($fileTxt));
    flock($df, 3);
    fclose($df);

    if (mb_detect_encoding($fStr) !== "UTF-8")
    {
        $charset = mb_detect_encoding($fStr);
        $fStr = iconv($charset,"UTF-8", $fStr);
    }
//    --------------------Delete spaces and pressed key enter in a file----------------------------

        if (strpos ($fStr, "\n"))
    {
        $fStr = str_replace(array("\r","\n")," ",$fStr);
    }
//    --------------------Transform string to array----------------------------
    $a1 = explode(' ', $fStr);
//    ------------------------ Check words for enters criteria---------------------
    $count = count($a1);
        for ($j = 0; $j < $count; $j ++) {
            if (mb_strlen($a1[$j]) > $countSymbols) {
                $a1[$j] = '';
            }
        }

    //---------------------------Transform array to string-------------------------------------------

    $stringForWrite = implode(' ', $a1);

    //------------------------------Open file for writing and write--------------------------------------------
    $df = fopen($fileTxt, 'w');
    if (!$df)
    {
        echo "Erorr open file! Try again.";
    }
    flock($df, 2);
    fwrite($df, $stringForWrite);
    flock($df, 3);
    fclose($df);
}
?>

