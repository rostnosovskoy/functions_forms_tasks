

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
            <label for="area1">Area1:</label>
            <textarea name="area1" id="area1" cols="10" rows="5" class="form-control"></textarea>
            <label for="area2">Area2:</label>
            <textarea name="area2" id="area2" cols="10" rows="5" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Compare</button>
    </form>
    <?php
    echo "<br />";
    if ($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        return;
    }
    $a = $_POST['area1'];
    $b = $_POST['area2'];
    $arr_words = getCommonWords($a, $b);
    echo "The same words:<br />";
    foreach ($arr_words as $val)
    {
        echo "<b>{$val}</b> ";
    }
    ?>
</div>
</body>
</html>

<?php

function getCommonWords($a, $b){
    $result = [];
    if ((mb_strpos ($a, "\n")) || (mb_strpos ($a, "\r")))
    {
        $a = str_replace(array("\r","\n")," ",$a);
    }
    if ((mb_strpos ($b, "\n")) || (mb_strpos ($b, "\r")))
    {
        $b = str_replace(array("\r","\n")," ",$b);
    }
    $a1 = explode(' ', $a);
    $a2 = explode(' ', $b);
    $a1 = array_diff($a1, array('', ' ', NULL, false));
    $a2 = array_diff($a2, array('', ' ', NULL, false));
    foreach ($a1 as $word) {
        if (in_array(trim($word), $a2)) {
            $result[] = $word;
        }
    }
    echo "Area1: $a <br />";
    echo "Area2: $b <br /><br />";
    return $result;
}
?>

