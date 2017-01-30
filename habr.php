<?php
    require 'function.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Хабр</title>
    <style>
        #form_table{
            margin: 400px auto;
            background-color: #f5e8d7;
            text-align: center;
            width: 700px;
        }
        p{
            text-align: justify;
        }
    </style>
</head>
<body>
<div id = "form_table">
    <?php if (!empty($error)) {
        echo "$error";
    }?>
    <form action="habr.php" method="get">
        ID:  <input type="text" name="id" /><br />
        <input type="submit" name="submit" value="Найти"/>
    </form>
        <?php if (!empty($json)) {
            echo "Json Строка <p>$json</p>";
        }?>
</div>

</body>
</html>