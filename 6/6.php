<!--Создать страницу, на которой можно загрузить несколько фотографий в
галерею. Все загруженные фото должны помещаться в папку gallery и выводиться
на странице в виде таблицы.-->

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
    <form action="6.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="userFile">Choose files:</label>
            <input type="file" min = "1" max = "9999" name="userFile[]" multiple = "true" class="form-control" />
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
    </form>


</div>
</body>
</html>

<?php

// ---------------------------------------- Decision -----------------------------------------

$uploadDir = 'gallery/'; //---------Directory for file--------------

//---------------------------------------Copy file from temp repository--------------------------------

//foreach ($_POST as $index => $value) {
//    $$index = $value;
//}
if (isset($_FILES['userFile']['name']))
    $countUpFiles = count($_FILES['userFile']['name']);
else
    $countUpFiles = 0;

for ($i = 0; $i < $countUpFiles; $i ++) {
    $uploadFile = $uploadDir.basename($_FILES['userFile']['name'][$i]);
    if (copy($_FILES['userFile']['tmp_name'][$i], $uploadFile))
    {
        $sf = (string)$_FILES['userFile']['name'][$i];
//        echo "Файл {$sf} успешно загружен на сервер <br />";
    }
    else
    {
        $errf = (string)$_FILES['userFile']['name'];
        echo "Ошибка! Не удалось загрузить файл {$errf} на сервер! < br />";
    }
}

if ($countUpFiles !== 0)
{
    $tbl = "<table style='width: 100%;'>";
    switch ($countUpFiles)
    {
        case 1:
            for ($j = 0; $j < $countUpFiles; $j ++) {
                $numFile = "gallery/" . $_FILES['userFile']['name'][$j];
                $tbl .= "<tr><td> <img src=' {$numFile}' alt='{$numFile}' style='width: auto; height: auto;' />  </td></tr>";
            }
            break;
        case 2:
            $tbl .="<tr>";
            for ($j = 0; $j < $countUpFiles; $j ++) {
                $numFile = "gallery/" . $_FILES['userFile']['name'][$j];
                $tbl .= "<td> <img src=' {$numFile}' alt='{$numFile}' style='width: 360px; height: 600px;'/></td> ";
            }
            $tbl .="</tr>";
            break;
        case 3:
            $tbl .="<tr>";
            for ($j = 0; $j < $countUpFiles; $j ++) {
                $numFile = "gallery/".$_FILES['userFile']['name'][$j];
                $tbl .= "<td align='left'> <img src=' {$numFile}' alt='{$numFile}' style='width: 360px; height: 600px;' /></td> ";
            }
            $tbl .="</tr>";
            break;
        default :
            for ($j = 0; $j < $countUpFiles; $j ++) {
                $numFile = "gallery/" . $_FILES['userFile']['name'][$j];
                $tbl .= "<tr><td> <img src=' {$numFile}' alt='{$numFile}' style='width: auto; height: auto;' />  </td></tr>";
            }
//            case 4:
//                $numFile = "gallery/".$_FILES['userFile']['name'][$j];
//                $tbl .= "<tr><td> <img src=' {$numFile}' alt='{$numFile}' />  </td></tr>";
//                break;
//            case 5:
//                $numFile = "gallery/".$_FILES['userFile']['name'][$j];
//                $tbl .= "<tr><td> <img src=' {$numFile}' alt='{$numFile}' />  </td></tr>";
//                break;
    }

    $tbl .= "</table>";
    echo $tbl;
}
else
{
    echo "Files didn't upload. Upload files, please.";
}


