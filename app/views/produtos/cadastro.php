<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="../public/css/produtos.css">
</head>
<body>

<div class="container">

    <h1>Cadastro de Produtos</h1>

    <?php if(isset($_SESSION['sucesso'])): ?>

        <div class="sucesso">
            <?= $_SESSION['sucesso']; ?>
        </div>

        <?php unset($_SESSION['sucesso']); ?>

    <?php endif; ?>

    <?php if (!empty($erro)): ?>
        <div class="erro">
            <?= $erro ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="row">
            <div class="campo">
                <label>Nome do Produto*</label>
                <input type="text" name="nome">
            </div>
        </div>

        <div class="row">

        <div class="campo">
            <label>Categoria*</label>
            <select name="categoria">
                <option value="">Selecione</option>
                <option value="Roupas">Roupas</option>
                <option value="Calçados">Calçados</option>
                <option value="Acessórios">Acessórios</option>
                <option value="Eletrônicos">Eletrônicos</option>
                <option value="Alimentos">Alimentos</option>
                <option value="Bebidas">Bebidas</option>
                <option value="Limpeza">Limpeza</option>
                <option value="Higiene">Higiene</option>
                <option value="Outros">Outros</option>
            </select>
        </div>

        <div class="campo">
            <label>Unidade*</label>

            <select name="unidade" required>
                <option value="UN">UN (Unidade)</option>
                <option value="KG">KG (Quilograma)</option>
                <option value="CX">CX (Caixa)</option>
                <option value="MT">MT (Metro)</option>
                <option value="LT">LT (Litro)</option>
            </select>
        </div>

        <div class="campo">
            <label>Código de Barras (opcional)</label>
            <input type="text" name="codigo_barras">
        </div>

    </div>

        <div class="row">
            <div class="campo">
                <label>Preço de Custo*</label>
                <input type="number" step="0.01" name="preco_custo">
            </div>

            <div class="campo">
                <label>Preço de Venda*</label>
                <input type="number" step="0.01" name="preco_venda">
            </div>
        </div>

        <div class="row">
            <div class="campo">
                <label>Estoque Atual*</label>
                <input type="number" name="estoque">
            </div>

            <div class="campo">
                <label>Estoque Mínimo*</label>
                <input type="number" name="estoque_minimo">
            </div>
        </div>

        <div class="botoes">
            <button class="salvar" type="submit">
                Salvar Produto
            </button>
        </div>

    </form>

</div>

</body>
</html>

