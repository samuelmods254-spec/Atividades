<?php
    $conn = pg_connect("host='localhost' port='5432' dbname='Loja' user='postgres' password='root'");

    $query = 'select * from produto';
    $result = pg_query($conn, $query);

    echo "Tabela de Produtos<br>";

    if (pg_num_rows($result) > 0) {
        while ($row = pg_fetch_assoc($result)) {
            $ID = $row['idproduto'];     
            $DESC = $row['descricao'];   
            $VALOR = $row['valor'];      
            $CTG = $row['idcategoria'];  

            echo $ID . " - " . $DESC . " - " . $VALOR . " - " . $CTG . "<br>";
        }  
    }
    else {
        echo "Nenhum resultado encontrado!!!";
    }

    pg_result_seek($result, 0);
    echo "<br><br>";
?>
