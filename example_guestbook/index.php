<?php
/***********************************************************
 *\  \    ___ __        /\     ____   ____  ____  __ |  |
 * \  \  /  /|  |      /  \   |  _ \ /  __>/    \|  ||  |
 *  \  \/  / |  |     / /\ \  | | \ \\_ \_ | || ||   \  |
 *   \    /  |  |__  /  __  \ | |_/ / _\  \| || ||  \   |
 *    \  /   |_____|/__/  \  \|____/ <____/\____/|  ||__|
 *     \/                  \  \                  |  |
 ***********************************************************
 *   This program is free software; you can  redistribute
 *   it  and/or  modify  it  under  the  terms of the GNU
 *   General Public License  as  published  by  the  Free
 *   Software Foundation.
 ***********************************************************
 *   Гостевуха написана по одной простой причине,
 *   я не нашёл ни одной настолько простой OpenSource
 *   гостевухи, которая бы не глючила.
 *   (Опытные программисты не пишут такие простые скрипты.)
 **********************************************************/

// Включение сжатия HTML кода, если доступно.
if (extension_loaded('gzip')) {
    ob_start('ob_gzhandler');
}

// Собственно название функции говорит за себя.
// Обычно не в моих правилах обрабатывать текст до добавления в базу,
// но в этом случае упор на простоту гостевухи, а не на понты.
function text2html($text) {
    // от функции nl2br отказался из соображений:
    // "всё равно без str_replace не обойтись так какого спрашивается хера."
    // была даже мысль без htmlspecialchars даже обойтись...
    return str_replace(
        array("\r\n", "\r", "\n", "\t"),
        array('<br>', '<br>', '<br>', '&nbsp; &nbsp; &nbsp;'),
        htmlspecialchars(trim($text))
    );
}

// Проверка была ли отправлена форма
if (array_key_exists('text', $_POST)) {
    //проверка есть ли текст сообщения
    if (trim($_POST['text']) != '') {
        // Проверка (и убирание) вселенского зла (волшебных кавычек)
        $_POST['text'] = get_magic_quotes_gpc() ? stripslashes($_POST['text']) : $_POST['text'];
        // проверка имени (в противном случае "Anonymous")
        $_POST['username'] = array_key_exists('username', $_POST) && trim($_POST['username']) != '' ? $_POST['username'] : 'Anonymous';
        // Проверка (и убирание) вселенского зла (волшебных кавычек)
        $_POST['username'] = get_magic_quotes_gpc() ? stripslashes($_POST['username']) : $_POST['username'];
        // обработка поста для записи в БД. (хоть и не особо в моём стиле, но "третий сорт - не брак")
        $post = sprintf("<b>%s</b> - <i>%s</i><br>%s\n",
            text2html($_POST['username']),
            gmdate('r'),
            text2html($_POST['text'])
        );
        // Добавление поста в базу.
        // (функция file_put_contents появилась только в РНР5, по этому на РНР4 гостевуха работать не будет)
        // Думаю излишне напоминать что на *nix системах файл БД должен существовать и быть доступным для записи.
        file_put_contents('guest.txt', $post, FILE_APPEND);
        // Запоминание ника в куках
        setcookie("username", $_POST['username'], time()+31536000);
    }
    // так как форма была отправлена, редирект на первую страницу.
    header('Location: ./');
    exit;
}

// Чтение в память всей БД
// (при не особо большой базе тормозов особо не будет)
$posts = file('guest.txt');

// Сортировка (чтоб новые были сверху)
krsort($posts);

// подсчёт постов
$posts_num = count($posts);

// кол-во постов на страницу
$pp = 10;

// заметьте при получении номера текущей страницы только проверка никаких фильтраций
// и тем более конверсий. Подробности: http://dkflbk.nm.ru/php_basic_err_1.html
$start = isset($_GET['start']) && ctype_digit($_GET['start']) ? $_GET['start'] : 0;

// собственно обрезание ненужного
$posts = array_slice($posts, $start, $pp);

// проверка запомненного имени (в противном случае "Anonymous")
$_COOKIE['username'] = array_key_exists('username', $_COOKIE) && trim($_COOKIE['username']) != '' ? $_COOKIE['username'] : 'Anonymous';

// Проверка (и убирание) вселенского зла (волшебных кавычек)
$_COOKIE['username'] = get_magic_quotes_gpc() ? stripslashes($_COOKIE['username']) : $_COOKIE['username'];

// Собственно шаблон.
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Guestbook.</title>
        <style type="text/css"><!--
            html {padding:16px;background-color:#ccc}
            body {background-color: #fff;width:672px;margin:auto;padding:24px;border:1px solid black;}
            h1, form {text-align:center}
            p {font-family: "Arial"}
        --></style>
    </head>
    <body>
        <h1><a href="">Guestbook</a></h1>
        <form action="" method="post">
            <p>
                <textarea name="text" cols="30" rows="7"></textarea>
                <br>
                <input type="text" name="username" value="<?php echo text2html($_COOKIE['username']);?>">
                <input value="Submit" type="submit">
            </p>
        </form>
        <hr>
        <p> Страницы:
<?php for($i = 0; $i < $posts_num; $i += $pp):?>
            &lt;<a href="?start=<?php echo $i;?>"><?php echo ($i+1) ."-" . ($i+$pp);?></a>&gt;
<?php endfor;?>
        </p>
        <hr>
<?php foreach($posts as $post):?>
        <p><?php echo trim($post);?></p><hr>
<?php endforeach;?>
        <p> Страницы:
<?php for($i = 0; $i < $posts_num; $i += $pp):?>
            &lt;<a href="?start=<?php echo $i;?>"><?php echo ($i+1) ."-" . ($i+$pp);?></a>&gt;
<?php endfor;?>
        </p>
        <hr>
        <p>&copy; 2004-2009 <a href="http://vladson.no-ip.org/">Vladson</a> &reg;</p>
    </body>
</html>