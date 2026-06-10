<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>

    <link rel="stylesheet" href="../public/css/listagem.css">
</head>
<body>

<div class="container">

    <div class="topo">
        <h1>Produtos Cadastrados</h1>

        <a href="?url=produtos" class="btn-novo">
            + Novo Produto
        </a>
    </div>

    <form method="GET">

        <input type="hidden" name="url" value="listar-produtos">

        <div class="row">

            <div class="campo">
                <label>Nome</label>
                <input
                    type="text"
                    name="nome"
                    value="<?= $_GET['nome'] ?? '' ?>">
            </div>

            <div class="campo">
                <label>Categoria</label>

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

        </div>

        <div class="row">

            <div class="campo">

                <label>Preço</label>

                <div class="filtro-linha">

                    <select name="operador_preco">
                        <option value="">Selecione</option>
                        <option value=">">Acima de</option>
                        <option value=">=">Maior ou igual</option>
                        <option value="<">Abaixo de</option>
                        <option value="<=">Menor ou igual</option>
                        <option value="=">Igual a</option>
                    </select>

                    <input
                        type="number"
                        step="0.01"
                        name="valor_preco"
                        placeholder="0,00">

                </div>

            </div>

            <div class="campo">

                <label>Estoque</label>

                <div class="filtro-linha">

                    <select name="operador_estoque">
                        <option value="">Selecione</option>
                        <option value=">">Acima de</option>
                        <option value=">=">Maior ou igual</option>
                        <option value="<">Abaixo de</option>
                        <option value="<=">Menor ou igual</option>
                        <option value="=">Igual a</option>
                    </select>

                    <input
                        type="number"
                        name="valor_estoque"
                        placeholder="Qtd">

                </div>

            </div>

        </div>

        <div class="botoes">

            <button type="submit" class="btn-pesquisar">
                Pesquisar
            </button>

        </div>

    </form>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Unidade</th>
                <th>Preço Venda</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>

       <tbody>

        <?php if(empty($produtos)): ?>

            <tr>
                <td colspan="6" style="text-align:center;">
                    Nenhum produto cadastrado.
                </td>
            </tr>

        <?php else: ?>

            <?php foreach($produtos as $produto): ?>

                <tr>

                    <td>
                        <?= $produto['id']; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($produto['prod_nome']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($produto['prod_categoria']); ?>
                    </td>

                    <td>
                        <?= $produto['prod_unidade']; ?>
                    </td>

                    <td>
                        R$ <?= number_format($produto['prod_preco_final'], 2, ',', '.'); ?>
                    </td>

                    <td>
                        <?= $produto['prod_estoque']; ?>
                    </td>

                    <td>
                        <a
                            href="?url=editar-produto&id=<?= $produto['id']; ?>"
                            class="editar">
                            Editar
                        </a>

                        <a href="?url=historico-estoque&id=<?= $produto['id']; ?>" class="editar">
                            Histórico
                        </a>

                        <a href="?url=movimentar-estoque&id=<?= $produto['id']; ?>" class="movimentar">
                            Movimentar
                        </a>

                        <a
                            href="?url=excluir-produto&id=<?= $produto['id']; ?>"
                            class="excluir"
                            onclick="return confirm('Deseja realmente excluir este produto?');">
                            Excluir
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>
</html>