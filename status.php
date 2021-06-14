<?php
    $result = "";
    if(isset($_POST['pais'])) //Se tiver algo no post.
    {
        $pais = $_POST['pais'];
        $result = shell_exec('python3 status.py '.$pais); // Chama o python passando por parametro o pais.
        $data = array("text" => $result); // transforma em um array
        header('Content-Type: application/json');
        http_response_code(200); // Deu certo
        echo json_encode($data); // manda o array
    }
    else{
        http_response_code(404); // Error
    }
?>