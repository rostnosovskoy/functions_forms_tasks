<!--Написать функцию, которая считает количество уникальных слов в тексте.
Слова разделяются пробелами. Текст должен вводиться с формы.-->

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

        echo "-----------------------------------------String---------------------------------------<br />";
        echo "<br />";
        echo $arr;
        echo "<br />";
        echo "<br />-------------------------Unique words in the text--------------------------<br />";
        echo "<br />";
        $fres = getUniqWords($arr);
        echo $fres;

    //----------------------------------------Simple variant---------------------------------
//    echo "<br />".strrev($arr);
    ?>

</div>
</body>
</html>

<?php

function getUniqWords($userStr)
{
//    --------------------------------------Delete spaces---------------------------------------------

    if (strpos ($userStr, "\n"))
    {
        $userStr = str_replace(array("\r","\n")," ",$userStr);
    }
    //---------------------------------Transfom to string to array-------------------------------------

    $userStr = explode(' ', $userStr);
    $countUnuniArr = count($userStr)-1; // -------- Count elements ---------------------------------
    $userStr = array_unique($userStr); // --------- Array unique elements --------------------------
    $count = count($userStr);  //----------- Count of array unique elements-------------------------
    $countUnuniEl = $countUnuniArr - ($count-1); //------ Count ununique elements ------------------
    $res = $countUnuniArr - $countUnuniEl; //------ Count ununique elements ---------------

    return $res;
}
?>

