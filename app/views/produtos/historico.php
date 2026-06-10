<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Estoque</title>
    <link rel="stylesheet" href="../public/css/movimentar.css">
</head>
<body>

<div class="container">

    <h1>Histórico de Estoque</h1>

    <p><strong>Produto:</strong> <?= htmlspecialchars($produto['prod_nome']?? ''); ?></p>

    <table>

        <thead>
            <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Quantidade</th>
                <th>Observação</th>
            </tr>
        </thead>

        <tbody>

        <?php if(empty($movimentacoes)): ?>

            <tr>
                <td colspan="4" style="text-align:center;">
                    Nenhuma movimentação encontrada.
                </td>
            </tr>

        <?php else: ?>

            <?php foreach($movimentacoes as $m): ?>

                <tr>

                    <td>
                        <?= date('d/m/Y H:i', strtotime($m['created_at'])); ?>
                    </td>

                    <td>
                        <?= strtoupper($m['move_tipo']); ?>
                    </td>

                    <td>
                        <?= $m['move_tipo'] == 'saida' ? '-' : '+'; ?>
                        <?= $m['move_quantidade']; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($m['move_observacao']); ?>
                    </td>

                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>
</html>
