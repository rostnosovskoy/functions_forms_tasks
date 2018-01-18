<!--Написать функцию, которая переворачивает строку. Было "abcde", должна выдать "edcba".-->

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
            <label for="text">Enter text:</label>
            <textarea name="text"  class="form-control"> </textarea>
        </div>
        <button type="submit" class="btn btn-success">Print</button>
    </form>

    <?php
        echo "<br />";
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            return;
        }
        $arr = $_POST['text'];

        echo "-----------------------------------------Before---------------------------------------<br />";
        echo "<br />";
        echo $arr;
        $c = getVsLine($arr);
        echo "<br />";
        echo "<br />-----------------------------------------After----------------------------------------<br />";
        echo "<br />";
        foreach ($c as $item) {
            echo $item . " ";
        }

    //----------------------------------------Simple variant---------------------------------
//    echo "<br />".strrev($arr);
    ?>

</div>
</body>
</html>

<?php

function getVsLine($userStr)
{
//    --------------------------------------Replacement new line characters for spaces---------------------------------------------

    if (mb_strpos ($userStr, "\n"))
    {
        $userStr = str_replace(array("\r","\n")," ",$userStr);
    }
    //    --------------------------------------Transfom to string to array-------------------------------------

    $a1 = explode(' ', $userStr);

    //    --------------------------------------Count of array elements-------------------------------------

    $count = count($a1);

    //    --------------------------------------Change places of worlds-------------------------------------

    for ($j = 0; $j < $count; $j ++) {
        $vsWord = [];
         $vs[$j] = $a1[($count-1)-$j];

        // ----------------------Change places litters in worlds-----------------------

        for ($i = 0; $i < strlen($vs[$j]); $i ++)
        {
            $vsWord[$i] = $vs[$j][(mb_strlen($vs[$j])-1)-$i];
        }

        $vsWord = join($vsWord); //------- Transfom from array to string-------
        $charset = mb_detect_encoding($vsWord); //-------Detect encoding------------
        $vsWord = iconv($charset, "UTF-8", $vsWord); //-------Change encoding to UTF-8-----------

        // ----------------------Assign changed world-----------------------
        $vs[$j] = (string)$vsWord;
    }

    return $vs;
}
?>

