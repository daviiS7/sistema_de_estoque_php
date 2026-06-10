<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Movimentar Estoque</title>
    <link rel="stylesheet" href="../public/css/movimentar.css">
</head>
<body>

<div class="container">

    <h1>Movimentar Estoque</h1>

    <?php if(isset($_SESSION['erro'])): ?>
        <div class="erro">
            <?= $_SESSION['erro']; ?>
        </div>
        <?php unset($_SESSION['erro']); ?>
    <?php endif; ?>

    <div class="info-produto">
        <p><strong>Produto:</strong> <?= htmlspecialchars($produto['prod_nome'] ?? '') ?></p>
        <p><strong>Estoque atual:</strong> <?= $produto['prod_estoque']?? '' ?></p>
    </div>

    <form method="POST">

        <input type="hidden" name="produto_id" value="<?= $produto['id'] ?? ''?>">

        <div class="row">

            <div class="campo">
                <label>Tipo de Movimentação</label>
                <select name="tipo">
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>
            </div>

            <div class="campo">
                <label>Quantidade</label>
                <input type="number" name="quantidade" min="1" required>
            </div>

        </div>

        <div class="row">

            <div class="campo">
                <label>Observação</label>
                <input type="text" name="observacao">
            </div>

        </div>

        <div class="botoes">
            <button type="submit" class="salvar">
                Confirmar Movimentação
            </button>
        </div>

    </form>

</div>

</body>
</html>