<!--Есть строка $string = 'яблоко черешня вишня вишня черешня груша яблоко
 черешня вишня яблоко вишня вишня черешня груша яблоко черешня черешня вишня
 яблоко вишня вишня черешня вишня черешня груша яблоко черешня черешня вишня
яблоко вишня вишня черешня черешня груша яблоко черешня вишня';<br>
<br>
Подсчитайте, сколько раз каждый фрукт встречается в этой строке. Выведите
 в виде списка в порядке уменьшения количества:<br><br>


Пример вывода:<br>
яблоко – 12<br>
черешня – 8<br>
груша – 5<br>
слива - 3<br>-->

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
        <button type="submit" col = "10" row = "10" class="btn btn-success">Print</button>
    </form>

    <?php
        echo "<br />";
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            return;
        }
        $arr = $_POST['text'];

        echo "-----------------------------------------Begin text---------------------------------------<br />";
        echo "<br />";
        echo $arr;
        echo "<br />";
        echo "<br />-----------------------------------Edited text---------------------------------------<br />";
        echo "<br />";
        countOfDiffWorlds($arr);

    //----------------------------------------Simple variant---------------------------------
//    echo "<br />".strrev($arr);
    ?>

</div>
</body>
</html>

<?php

function countOfDiffWorlds($userStr)
{
    //--------------------------------------Replacement new line characters for spaces---------------------------------------------

    if (strpos ($userStr, "\n"))
    {
        $userStr = str_replace(array("\r", "\n", "\t")," ", $userStr);
    }
    //-------------------------------------------------------------------------------------------------

    //---------------------------------Transfom to string to array-------------------------------------

    $userStrArr = explode(' ', $userStr);

    //-------------------------------------------------------------------------------------------------

    //-------------------------Delete spaces and another characters from array elements-------------------------------------

    foreach ($userStrArr as &$item) {
        $item = trim ($item, " \n\r\t"); //---Deleteing spaces, tabs, newline characters---------
    }
    //-------------------------------------------------------------------------------------------------

    //---------------------------------Delete duplicate elements from array-------------------------------------

    $uniArray = array_unique ($userStrArr);

    //-------------------------------------------------------------------------------------------------

    //------------------------------- Output count words in text ------------------------------------
    foreach ($uniArray as $item)
    {
        if ((($item == '\r') || ($item == '\n')) && ($item == '') || ($item == ''))
        {
            continue; //------------------ Skip empty array elements---------------------
        }
        $countRep = substr_count ($userStr, $item); //------Detect count repeated in text---------
        $sortArray[$item] = $countRep;  //----Create new array where key is word and value is count repeated in text---
    }
    //-----------------------------Sorting array in descending order--------------------------------------

    arsort($sortArray);

//    -----------------------------------------------------------------------------------------------------

    //------------------------------Output sort array------------------------------------------------------

    foreach ($sortArray as $k => $item) {
        echo $k ." - ". $item. "<br />";
    }
//    -----------------------------------------------------------------------------------------------------

}
?>

