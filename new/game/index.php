<?php
    require_once('../conf/defines.php');
    require_once('./functions.php');

    ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        $cardValues = ['id' => 1, 'name' => 'Baron Jean Miche Miche', 'desc' => 'Lorem vlsdkjfmlksj, fnsd', 'imgurl' => 'localhost/qksjdqjd','cost' => 3, 'atk' => 3, 'hp' => 5];
        $creature = new Creature();
        $creature->setAtk(10);
        $creature->setId(10);
        $creature->hydrate($cardValues);
        var_dump($creature);

        // require_once(ROOT_PATH . 'classes\card\vues\card.vue.php');
    ?>
</body>
</html>  