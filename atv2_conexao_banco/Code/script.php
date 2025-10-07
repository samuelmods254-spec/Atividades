<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IdCliente = $_POST["cliente"];
    $conn = pg_connect("host='localhost' port='5432' dbname='LOJA' user='postgres' password='root'");


  $query = 'select v.id_venda, v.id_cliente, v.data_venda, v.imposto, vi.quantidade
		, vi.id_venda_item, vi.id_produto, vi.valor_unitario, v.frete,
		c.nome, c.rua, c.numero, c.cidade, c.uf, p.descricao, a.descricao, vi.quantidade * vi.valor_unitario as valor_total
    from venda v
    inner join venda_item vi on (v.id_venda = vi.id_venda)
	  inner join cliente c on (v.id_cliente = c.id_cliente)
    inner join produto p on (vi.id_produto = p.id_produto)
    inner join categoria a on (p.id_categoria = p.id_categoria)
    where v.id_cliente = ' .$IdCliente;
    $result = pg_query($conn, $query);
    if (pg_num_rows($result) > 0) { 
        while ($row = pg_fetch_assoc($result)) { 
            $ID = $row['id_cliente']; 
            $IdVenda = $row['id_venda'];
            $datavenda = $row['data_venda'];
            $Imposto =  $row['imposto'];
            $QTD = $row['quantidade'];
            $id_venda_item = $row['id_venda_item'];
            $idProduto = $row['id_produto'];
            $ValorUNit = $row['valor_unitario'];
            $frete = $row['frete'];
            $nome = $row['nome'];
            $rua = $row['rua'];
            $numero = $row['numero'];
            $cidade = $row['cidade'];
            $UF = $row['uf'];
            $Pdescricao = $row['descricao'];
            $Cdescric = $row['descricao'];
            $total = $row['valor_total'];

        echo $ID." - ".$IdVenda." - ".$datavenda." - ".$Imposto." - ".$QTD." - ".$id_venda_item." - ".$idProduto." - ".$ValorUNit." - ".$frete." - ".$nome." - ".$rua." - ".$numero." - ".$cidade." - ".$UF." - ".$Pdescricao." - ".$Cdescric." - ".$total."<br>"; 
        }  
    }
    else{
        echo "nenhum resultado encontrado!!!";
    }

    pg_result_seek($result, 0);
		echo "<br>";
		echo "<br>";









  };
?>