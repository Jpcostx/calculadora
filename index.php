<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
    <!-- Aqui nós conectamos o arquivo CSS externo -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="calculadora-container">
        <h2 class="titulo">Calculadora</h2>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="num1">Primeiro Número:</label>
                <input type="number" id="num1" name="num1" step="any" placeholder="Ex: 10,5" required>
            </div>
            
            <div class="form-group">
                <label for="operacao">Operação:</label>
                <select id="operacao" name="operacao" required>
                    <option value="" disabled selected>Escolha uma operação...</option>
                    <option value="somar">Somar (+)</option>
                    <option value="subtrair">Subtrair (-)</option>
                    <option value="multiplicar">Multiplicar (×)</option>
                    <option value="dividir">Dividir (÷)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="num2">Segundo Número:</label>
                <input type="number" id="num2" name="num2" step="any" placeholder="Ex: 5" required>
            </div>
            
            <button type="submit" class="btn-calcular">Calcular</button>
        </form>

        <?php
        // Verifica se o formulário foi enviado pelo método POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Pegando os dados do formulário e convertendo para float para aceitar decimais
            $num1 = isset($_POST["num1"]) ? floatval($_POST["num1"]) : 0;
            $num2 = isset($_POST["num2"]) ? floatval($_POST["num2"]) : 0;
            $operacao = isset($_POST["operacao"]) ? $_POST["operacao"] : "";
            
            $resultado = "";
            $teve_erro = false;

            // Estrutura condicional para decidir qual conta fazer
            if ($operacao == "somar") {
                $resultado = $num1 + $num2;
            } elseif ($operacao == "subtrair") {
                $resultado = $num1 - $num2;
            } elseif ($operacao == "multiplicar") {
                $resultado = $num1 * $num2;
            } elseif ($operacao == "dividir") {
                // não pode dividir por zero
                if ($num2 == 0) {
                    $resultado = "Erro: Divisão por zero!";
                    $teve_erro = true;
                } else {
                    $resultado = $num1 / $num2;
                }
            } else {
                $resultado = "Por favor, selecione uma operação.";
                $teve_erro = true;
            }

            // Mostrando o resultado na tela
            echo "<div class='area-resultado'>";
            
            if ($teve_erro) {
                // Se deu erro, mostra com a classe CSS de erro
                echo "<div class='visor-resultado erro'>" . $resultado . "</div>";
            } else {
                // Se deu certo, formata o número pra ficar bonito
                $resultado_formatado = str_replace('.', ',', (string)$resultado);
                echo "<div class='visor-resultado'> = " . $resultado_formatado . "</div>";
            }
            
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>