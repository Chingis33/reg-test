<?php

ini_set('default_charset','utf-8');
?>

<!-- Небольшая лапша, форма введения урла -->
<!DOCTYPE html>
<html>
<head>
    <title>Определение статуса ИНН</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<main>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="input-inn">Введите ИНН:</label>
                <input type="text" class="form-control" id="input-inn" aria-describedby="help-inn" placeholder="ИНН" name="inn" required>
            </div>
            <button type="submit" class="btn btn-primary">Проверить</button>
        </form>
    </div>
</main>
</body>
</html>
<?
    if (isset($_POST['inn'])){
        include_once ('authenticity.php');
        $authenticity = new Authenticity();
        echo '<p>Проверка ИНН=' . $_POST['inn'] . ':</p><pre>';
        print_r($authenticity->get($_POST['inn']));
        echo '</pre>';
    }
