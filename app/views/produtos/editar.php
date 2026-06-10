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

    <h1>Editar Informações do Produto</h1>

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
        <input
            type="hidden"
            name="id"
            value="<?= $produto['id'] ?? '' ?>">

        <div class="row">
            <div class="campo">
                <label>Nome do Produto*</label>
                <input
                    type="text"
                    name="nome"
                    value="<?= htmlspecialchars($produto['prod_nome'] ?? ''); ?>">
            </div>
        </div>

        <div class="row">

            <div class="campo">
            <label>Categoria*</label>

            <select name="categoria">

                <option value="">Selecione</option>

                <option value="Roupas"
                    <?= $produto['prod_categoria'] ?? '' == 'Roupas' ? 'selected' : ''; ?>>
                    Roupas
                </option>

                <option value="Calçados"
                    <?= $produto['prod_categoria'] ?? '' == 'Calçados' ? 'selected' : ''; ?>>
                    Calçados
                </option>

                <option value="Acessórios"
                    <?= $produto['prod_categoria'] ?? '' == 'Acessórios' ? 'selected' : ''; ?>>
                    Acessórios
                </option>

                <option value="Eletrônicos"
                    <?= $produto['prod_categoria'] ?? '' == 'Eletrônicos' ? 'selected' : ''; ?>>
                    Eletrônicos
                </option>

                <option value="Alimentos"
                    <?= $produto['prod_categoria'] ?? '' == 'Alimentos' ? 'selected' : ''; ?>>
                    Alimentos
                </option>

                <option value="Bebidas"
                    <?= $produto['prod_categoria'] ?? '' == 'Bebidas' ? 'selected' : ''; ?>>
                    Bebidas
                </option>

                <option value="Limpeza"
                    <?= $produto['prod_categoria'] ?? '' == 'Limpeza' ? 'selected' : ''; ?>>
                    Limpeza
                </option>

                <option value="Higiene"
                    <?= $produto['prod_categoria'] ?? '' == 'Higiene' ? 'selected' : ''; ?>>
                    Higiene
                </option>

                <option value="Outros"
                    <?= $produto['prod_categoria'] ?? '' == 'Outros' ? 'selected' : ''; ?>>
                    Outros
                </option>

            </select>
        </div>

        <div class="campo">
            <label>Unidade*</label>

            <select name="unidade" required>
                <option value="UN" <?= $produto['prod_unidade'] ?? '' == 'UN' ? 'selected' : '' ?>>UN</option>
                <option value="KG" <?= $produto['prod_unidade'] ?? '' == 'KG' ? 'selected' : '' ?>>KG</option>
                <option value="CX" <?= $produto['prod_unidade'] ?? '' == 'CX' ? 'selected' : '' ?>>CX</option>
                <option value="MT" <?= $produto['prod_unidade'] ?? '' == 'MT' ? 'selected' : '' ?>>MT</option>
                <option value="LT" <?= $produto['prod_unidade'] ?? '' == 'LT' ? 'selected' : '' ?>>LT</option>
            </select>
        </div>

        <div class="campo">
            <label>Código de Barras (opcional)</label>
            <input
            type="text"
            name="codigo_barras"
            value="<?= htmlspecialchars($produto['prod_cod_barra'] ?? ''); ?>">
        </div>

    </div>

        <div class="row">
            <div class="campo">
                <label>Preço de Custo*</label>
                <input
                type="number"
                step="0.01"
                name="preco_custo"
                value="<?= $produto['prod_custo'] ?? '' ?>">
            </div>

            <div class="campo">
                <label>Preço de Venda*</label>
                <input
                type="number"
                step="0.01"
                name="preco_venda"
                value="<?= $produto['prod_preco_final'] ?? '' ?>">
            </div>
        </div>

        <div class="row">
            <div class="campo">
                <label>Estoque Atual*</label>
                <input
                type="number"
                name="estoque"
                value="<?= $produto['prod_estoque'] ?? '' ?>">
            </div>

            <div class="campo">
                <label>Estoque Mínimo*</label>
                <input
                type="number"
                name="estoque_minimo"
                value="<?= $produto['prod_estoque_min'] ?? '' ?>">
            </div>
        </div>

        <div class="botoes">
            <button class="salvar" type="submit">
                Atualizar produto Produto
            </button>
        </div>

    </form>

</div>

</body>
</html>


