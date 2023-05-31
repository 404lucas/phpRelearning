<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="post">
        <input type="text" name="1" placeholder="insira o valor 1" />
        <br />
        <input type="text" name="2" placeholder="insira o valor 2" />
        <br />
        <input type="text" name="3" placeholder="insira o valor 3" />
        <br />
        <input type="text" name="4" placeholder="insira o valor 4" />
        <br />
        <input type="text" name="5" placeholder="insira o valor 5" />
        <br />
        <input type="submit" name="enviar" value="enviar" />
    </form>
    <?php
    $array = [];
    $maiorValor = 0;
    if (isset($_POST['enviar'])) {
        $elementCount = count($_POST);

        for ($i = 1; $i < $elementCount; $i++) {
            array_push($array, $_POST[$i]);
            $valorAtual = $_POST[$i];
            if ($valorAtual > $maiorValor) {
                $maiorValor = $valorAtual;
            }
        }

        foreach ($array as $key => $value) {
            echo $key . $value . "<br/>";
        }
        echo "maior valor é " . $maiorValor;
    }
    ?>
    <hr>
    <h1>Adicionar pizzas</h1>
    <form method="post">
        <input type="text" name="sabor" require>
        <input type="submit" name="send" value="adicionar">
    </form>
    <?php
    if (isset($_POST['send'])) {
        $sabor = $_POST['sabor'];

        $pizza = new pizza();
        $pizza->sabor = $sabor;

        $ingredientes = array(1,2);
        $ingredientes = serialize($ingredientes);

        myserver::insertPizza($pizza->sabor, $ingredientes);
    }

    $pizzaList = myserver::listPizzas();
    

    foreach ($pizzaList as $key => $value) {
        echo '<hr>' . $value['id'] . ' - ' . $value['sabor'];
    ?>

        <form method='post' action="excluir.php">
            <input type="hidden" name="id" value="<?php echo $value['id']; ?> " />
            <input type="submit" name="delete" value="Excluir"/>
        </form>

    <?php

        $unserializes = unserialize($value['ingredientes_ids']);

        foreach ($unserializes as $key => $value) {
        
            $ingredient = connectionFactory::connect()->prepare("SELECT * FROM ingredientes WHERE id = '$value'");
            $ingredient->execute();
            $ingredient = $ingredient->fetchAll();

            foreach ($ingredient as $key => $value) {
                echo $value['nome'];
            }

    }
    }
    ?>
</body>

</html>