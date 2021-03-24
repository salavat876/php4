<?php ?>
<?php require_once "form.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="/" method="post" class="flex-block">
    <input type="text" name="firstName" value="">
    <input type="text" name="lastName">
    <input type="text" name="login">
    <input type="text" name="password">
    <button type="submit">Отправить</button>
</form>

    <?php $validate = valid($_POST); ?>
    <?php if (!empty($validate['succes']) && $validate['succes']) {
        foreach ($validate['messages'] as $message){
           echo '<p>'.$message.'<p>';
        }
    } ?>

<?php print_r($validate) ; ?>
</body>
</html>
