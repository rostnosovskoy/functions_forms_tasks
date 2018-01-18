<!--Создать гостевую книгу, где любой человек может оставить комментарий
в текстовом поле и добавить его. Все добавленные комментарии выводятся над
текстовым полем.
Реализовать проверку на наличие в тексте запрещенных слов, матов.
При наличии таких слов - выводить сообщение "Некорректный комментарий".
Реализовать удаление из комментария всех тегов, кроме тега &lt;b&gt;.-->



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
    <title>Guestbook</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css" >
<body>
<div>
    <h2 title="This is guestbook create for everyone">Guestbook</h2>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    return;
}
//-------------------------------Replace spesial haracters-------------------------
function repText($txtMsg)
{
    $txtMsg = strip_tags($txtMsg, "<b>"); //---------Delete html tags--------------
    return str_replace(array("\n", "\r\n", "\t"), array("<br />", "<br />",
        "&nbsp; &nbsp; &nbsp;"), htmlspecialchars(trim($txtMsg)));
}

//---------------------------------------------------------------------------------

if (array_key_exists('msg', $_POST)) { //-------- Check the send form info-----------
    if (trim($_POST['name']) == '') { //-------If name is empty then ---------------
        $_POST['name'] = 'Anonymous'; //--------default name is anonimous-------------
    }
    //----------------Check the message. If message is empty then exit from program ---------------
    if (trim($_POST['msg']) == '') {
        echo "You forgot enter message. Try again.";
        exit();
    }
    //----------------------------------------------------------------------------------------------

    $fw = file('forbiddenWords.txt'); //-------Get forbidden word from file-------------

    //---------------------------------Check each forbidden word is in text or not---------------------------
    foreach ($fw as $item) {
        if (@mb_strstr($_POST['msg'], trim($item)))
        {
            $_POST['msg'] = "Некорректный комментарий";
        }
    }
    //----------------------------------------------------------------------------------------------


    $name = $_POST['name'];
    $msg = $_POST['msg'];
    date_default_timezone_set('Europe/Riga'); //-------Set timezone for Kyev---------------
    $postDate = date('D, d m Y H:i:s'); //------------Set date format---------------------

    //------------------Set format record to file------------------------------------------------------------
    $userMsg = sprintf("\n<b> %s </b> <i> %s </i><br /> %s <hr>", trim($name), $postDate, repText($msg));
    //-------------------------------------------------------------------------------------------------------
    //------------------------Wite data to file. Flag FILE_APPEND use for add data and don't rewite date to file------
    file_put_contents('baseForGuestBook.txt', $userMsg, FILE_APPEND);
    //-------------------------------------------------------------------------------------------------------

}

//-----------------Create array where every line from file is array element------------------------------------------
$linesArray = file('baseForGuestBook.txt', FILE_SKIP_EMPTY_LINES);
//--------------------------------------------------------------------------------------------------------------

ksort($linesArray); //-------------------------Sort array by key in reverse order-------------------------------

echo "<hr>"; //--------------Horizontal line will separate each array element -----------------------------------
//-----------------------------------------Print array-----------------------------------------------------------
foreach ($linesArray as $item) {
    echo "{$item} <br />";
}
//--------------------------------------------------------------------------------------------------------------
?>

<div class="container">
    <form action="8.php" method="post">
        <div class="form-group">
            <lable for = "name">Enter your name:</lable>
            <input type="text" name="name" placeholder="Name.." title="You must enter your name here" class="form-control" />
            <lable for = "msg">Enter your messase:</lable>
            <textarea name="msg" rows="5" cols="120" placeholder="Message.." class="form-control" title="Write here your message, please."></textarea>
        </div>
        <button type="submit" name="sendMsg" class="btn btn-success">Publish</button>
    </form>
</div>
</body>
</html>

