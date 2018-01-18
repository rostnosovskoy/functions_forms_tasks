<!--Создать форму с элементом textarea. При отправке формы скрипт должен-->
<!--выдавать ТОП3 длинных слов в тексте. Реализовать с помощью функции.-->

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
    <form action="2.php" method="post">
        <div class="form-group">
            <label for="area1">Area:</label>
            <textarea name="area1" id="area1" cols="10" rows="5" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Print</button>
    </form>

    <?php
        echo "<br />";
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            return;
        }
        $arr = $_POST['area1'];

        echo "-----------------------------------------Before---------------------------------------<br />";
        echo "<br />";
        echo $arr;
        $c = getTop3Words($arr);
        echo "<br />";
        echo "<br />-----------------------------------------After----------------------------------------<br />";
        echo "<br />";
        echo $c;
    ?>

</div>
</body>
</html>

<?php

function getTop3Words($a)
{
    if (strpos ($a, "\n"))
    {
        $a = str_replace(array("\r","\n")," ",$a);
    }
    $a1 = explode(' ', $a);
    // sort array
    $count = count($a1);
    for ($i = $count-1; $i >= 0; $i --) {
        for ($j = 0; $j < $i; $j ++) {
            if (strlen($a1[$j]) > strlen($a1[$j+1])) {
                $t = $a1[$j];
                $a1[$j] = $a1[$j + 1];
                $a1[$j + 1] = $t;
            }
        }
    }

    // Print last 3.txt elements
    $result = $a1[$count-1]." ".$a1[$count-2]." ".$a1[$count-3];
    return $result;
}
?>

