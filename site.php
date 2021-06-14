<?php


$result = shell_exec('python3 paises.py');
$arrCombo = json_decode($result);
// Carrega a variavel com o resultado do python Paises e tranforma em um array PHP.

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <title>Detalhes do Covid</title>


    <style>

      .paraanimacao{
        margin-top:50px;
      }


    </style>

  </head>
  <body>
    <div class="Container">
        <h1 class="text-center">Projeto Covid</h1>
        <hr/>
          <div class="row text-center p-5">
            <div class="col-4 offset-4 md-3">
    
              
              <div class="w3-container w3-center w3-animate-top" style="Border: 1px solid black" id="teste" hidden>
                <div class="row">
                  <div class="col-12">
                    <span class="h6">Pais: </span>
                    <span id="pais"></span>
                  </div>
                  <div class="col-12">
                    <span class="h6">Confirmados: </span>
                    <span id="conf"></span>
                  </div>
                  <div class="col-12">
                    <span class="h6">Recuperados: </span>
                    <span id="rec"></span>
                  </div>
                  <div class="col-12">
                    <span class="h6">Mortes: </span>
                    <span id="mor"></span>
                  </div>
                </div>
              </div>

              <p id="carregar" class="w3-animate-opacity" hidden><i class="fa fa-spinner w3-spin" style="font-size:32px"></i></p>

              <select name="cidades" class="form-select" id="paises" style="transition: margin .5s">
                <option value="Paises">Paises</option>
                <?php foreach ($arrCombo as $key => $value): ?>
                        <?php echo "<option value=\"$value\" >$value</option>"; ?>
                    <?php endforeach; ?>
                <!-- Carrega o Select com as opçoes do array. -->

              </select>
            </div>
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>

  <script>

            $("#paises").change(function(){  // Quando o select muda.
              var pais = $("#paises").val() // Pega o valor do select.

              $("#paises").removeClass("paraanimacao");
              $("#teste").attr("hidden",true);
              $("#carregar").attr("hidden",false);
              //Animação.

              if(pais != "Paises"){

                //Chamada Ajax para pegar as informaçoes pelo python
                $.ajax({
                    type: "POST",
                    timeout: 0,
                    url: 'status.php',
                    dataType: 'json',
                    data: {pais: $("#paises").val()},
                    success: function(data){
                        var json = JSON.parse(data.text);

                        
                        $("#pais").text(json["Pais"]);
                        $("#conf").text(json["Confirmado"]);
                        $("#rec").text(json["recuperado"]);
                        $("#mor").text(json["mortes"]);
                        //Carrega as informaçoes no html


                        $("#paises").addClass("paraanimacao");
                        $("#teste").removeAttr("Hidden");
                        $("#carregar").attr("hidden",true);
                        //Mostra a div com as informações e Animação.

                    }
                });
              }else{
                $("#carregar").attr("hidden",true);
              }
            })
        </script>

</html>




