<!--Написать функцию, которая в качестве аргумента принимает строку, и
форматирует ее таким образом, что каждое новое предложение начиняется с большой буквы.<br>
Пример:<br><br>
Входная строка: 'а васька слушает да ест. а воз и ныне там. а вы друзья
как ни садитесь, все в музыканты не годитесь. а король-то — голый. а ларчик
просто открывался.а там хоть трава не расти.';<br><br>
Строка, возвращенная функцией :  'А Васька слушает да ест. А воз и ныне там.
 А вы друзья как ни садитесь, все в музыканты не годитесь. А король-то — голый.
 А ларчик просто открывался.А там хоть трава не расти.';-->

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
        <button type="submit" col = "10" row = "5" class="btn btn-success">Print</button>
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
        echo "<br />-----------------------------------Edited text--------------------------<br />";
        echo "<br />";
        $fres = vsOrderSent($arr);
        echo $fres;

    ?>

</div>
</body>
</html>

<?php

function vsOrderSent($userStr)
{
    //---------------------------------Transfom to string to array-------------------------------------

    $userStr = explode('.', $userStr);
    //-------------------------------------------------------------------------------------------------

    $count = count($userStr);    //------Count of array elements-----

    //-------------------------------Output array elements in vs order------------------------------------

    for ($i = $count-1; $i >= 0; $i --)
    {
        if ((($userStr[$i] == '\r') || ($userStr[$i] == '\n')) && ($userStr[$i] == '') || ($userStr[$i] == ''))
        {
            continue; //------ Skip empty array elements---------------------
        }
        echo $userStr[$i].". ";
    }
    //-------------------------------------------------------------------------------------------------

}
?>

