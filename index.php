<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #2c3e50; /* Fundo escuro elegante */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        .calculadora-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            padding: 25px;
            width: 320px;
        }

        .titulo {
            text-align: center;
            margin-top: 0;
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
            color: #555;
        }

        input[type="number"], select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box; 
            transition: border-color 0.3s ease;
        }

        input[type="number"]:focus, select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        .btn-calcular {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
            margin-top: 10px;
        }

        .btn-calcular:hover {
            background-color: #2980b9;
        }

        .btn-calcular:active {
            transform: scale(0.98);
        }

        .area-resultado {
            margin-top: 25px;
            text-align: center;
        }

        .visor-resultado {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            border: 2px dashed #bdc3c7;
            word-wrap: break-word;
        }

        .erro {
            color: #e74c3c;
            font-size: 18px;
            border-color: #e74c3c;
            background-color: #fadbd8;
        }
    </style>
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
            // Usei isset para evitar erros se algo não for enviado corretamente
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
                // Usei str_replace para trocar ponto por vírgula no padrão brasileiro
                $resultado_formatado = str_replace('.', ',', (string)$resultado);
                echo "<div class='visor-resultado'> = " . $resultado_formatado . "</div>";
            }
            
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>