<?php

if(isset($_POST['submit']))
{   
    include_once('config.php');

      $nome = $_POST['nome'];
      $email = $_POST['email'];     
      $senha = $_POST['senha'];
      $cotacao = $_POST['cotacao'];
      $resultado = mysqli_query($conexao, "INSERT INTO usuarios(nome,email,senha,cotacao) VALUES ('$nome','$email','$senha','$cotacao')");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
     $(document).ready(function() {
         // Fazer uma solicitação para obter a cotação do bitcoin
     fetch('https://api.coincap.io/v2/assets/bitcoin')
     .then(response => response.json())
     .then(data => {
      // Obter o valor da cotação do bitcoin
      var cotacao = data.data.priceUsd;

      // Definir o valor da cotação no campo de formulário correspondente
      $('#cotacao').val(cotacao);
      })
     .catch(error => {
      // Exibir uma mensagem de erro
      console.error('Ocorreu um erro ao obter a cotação do bitcoin:', error);
     });

     // Adicionar um manipulador de eventos para o formulário de registro
     $('#registro-form').submit(function(event) {
     // Impedir que o formulário seja enviado normalmente
     event.preventDefault();

     // Obter os dados do formulário
      var formData = {
      nome: $('#nome').val(),
      email: $('#email').val(),
      cotacao: $('#cotacao').val(),
      senha: $('#senha').val()
    };

    // Enviar uma solicitação POST para o backend
    $.ajax({
      type: 'POST',
      url: '/formulario.php',
      data: formData,
      success: function(response) {
        // Exibir uma mensagem de sucesso
        alert('Registro salvo com sucesso!');
      },
      error: function(xhr, status, error) {
        // Exibir uma mensagem de erro
        alert('Ocorreu um erro ao salvar o registro: ' + error);
      }
    });
  });
});

      </script>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(118, 120, 68), rgb(68, 74, 1));
            }
        .box{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.4);
            padding: 15px;
            border-radius: 10px;
            width: 20%;
        }
        fieldset{
            border: 2px solid yellow;
        }
        legend{
            border: 1px solid rgb(223, 223, 57);
            padding: 10px;
            text-align: center;
            background-color: rgb(223, 223, 57);
            border-radius: 10px;
            color: rgb(15, 14, 2);
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelinput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;

        }
        .inputUser:focus ~ .labelinput,
        .inputUser:valid ~ .labelinput{
            top: -20px;
            font-size: 10px;
            color: rgb(232, 232, 136);
        }
        #submit{
            background-image: linear-gradient(to right, rgb(118, 120, 68), rgb(68, 74, 1)); 
            width: 100%;
            border: none;
            padding: 15px;
            color: aliceblue;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right, rgb(122, 126, 78), rgb(78, 84, 11));
        }
    </style>
</head>
<body>
    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><strong>Formulário Bit coin</strong></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelinput">Nome Completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" required>
                    <label for="nome" class="labelinput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text"  name="senha" id="senha" class="inputUser" required>
                    <label for="nome" class="labelinput">Senha</label>
                </div>
               
                <br><br>
                <div class="inputBox">
                    <input type="text"  name="cotacao" id="cotacao" class="inputUser" required>
                    <label for="nome" class="labelinput">Cotação</label>
                </div>
               
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>