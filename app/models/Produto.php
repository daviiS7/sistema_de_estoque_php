<?php

require_once __DIR__ . '/../../config/database.php';

class Produto
{
    public static function salvar($dados)
    {
        $pdo = Database::conectar();

        $sql = "INSERT INTO produtos
        (
            prod_nome,
            prod_categoria,
            prod_cod_barra,
            prod_custo,
            prod_preco_final,
            prod_estoque,
            prod_estoque_min,
            prod_unidade
        )
        VALUES
        (
            :nome,
            :categoria,
            :codigo,
            :custo,
            :preco,
            :estoque,
            :estoque_min,
            :unidade
        )";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':nome'        => $dados['nome'],
            ':categoria'   => $dados['categoria'],
            ':codigo'      => $dados['codigo_barras'],
            ':custo'       => $dados['preco_custo'],
            ':preco'       => $dados['preco_venda'],
            ':estoque'     => $dados['estoque'],
            ':estoque_min' => $dados['estoque_minimo'],
            ':unidade'     => $dados['unidade'] ?? 'UN'
        ]);
    }

    public static function listarTodos()
    {
        $pdo = Database::conectar();

        $sql = "SELECT * FROM produtos ORDER BY id DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function pesquisar($filtros)
    {
        $pdo = Database::conectar();

        $sql = "SELECT * FROM produtos WHERE 1=1";

        $params = [];

        if (!empty($filtros['nome'])) {
            $sql .= " AND prod_nome LIKE :nome";
            $params[':nome'] = '%' . $filtros['nome'] . '%';
        }

        if (!empty($filtros['categoria'])) {
            $sql .= " AND prod_categoria = :categoria";
            $params[':categoria'] = $filtros['categoria'];
        }

        if (!empty($filtros['operador_preco']) && $filtros['valor_preco'] !== '') {
            $sql .= " AND prod_preco_final " . $filtros['operador_preco'] . " :preco";
            $params[':preco'] = $filtros['valor_preco'];
        }

        if (!empty($filtros['operador_estoque']) && $filtros['valor_estoque'] !== '') {
            $sql .= " AND prod_estoque " . $filtros['operador_estoque'] . " :estoque";
            $params[':estoque'] = $filtros['valor_estoque'];
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id)
    {
        $pdo = Database::conectar();

        $sql = "SELECT * FROM produtos WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function atualizar($dados)
    {
        $pdo = Database::conectar();

        $sql = "UPDATE produtos SET
            prod_nome = :nome,
            prod_categoria = :categoria,
            prod_cod_barra = :codigo,
            prod_custo = :custo,
            prod_preco_final = :preco,
            prod_estoque = :estoque,
            prod_estoque_min = :estoque_min,
            prod_unidade = :unidade
            WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $dados['id'],
            ':nome' => $dados['nome'],
            ':categoria' => $dados['categoria'],
            ':codigo' => $dados['codigo_barras'],
            ':custo' => $dados['preco_custo'],
            ':preco' => $dados['preco_venda'],
            ':estoque' => $dados['estoque'],
            ':estoque_min' => $dados['estoque_minimo'],
            ':unidade' => $dados['unidade'] ?? 'UN'
        ]);
    }

    public static function excluir($id)
    {
        $pdo = Database::conectar();

        $sql = "DELETE FROM produtos WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    public static function movimentarEstoque($dados)
    {
        $pdo = Database::conectar();

        $sql = "INSERT INTO mov_estoque
            (produto_id, move_tipo, move_quantidade, move_observacao)
            VALUES
            (:produto_id, :tipo, :quantidade, :observacao)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':produto_id' => $dados['produto_id'],
            ':tipo' => $dados['tipo'],
            ':quantidade' => $dados['quantidade'],
            ':observacao' => $dados['observacao']
        ]);
    }

    public static function atualizarEstoque($id, $novoEstoque)
    {
        $pdo = Database::conectar();

        $sql = "UPDATE produtos 
                SET prod_estoque = :estoque
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':estoque' => $novoEstoque,
            ':id' => $id
        ]);
    }

    public static function historicoMovimentacoes($produtoId)
    {
        $pdo = Database::conectar();

        $sql = "SELECT * FROM mov_estoque
                WHERE produto_id = :id
                ORDER BY id DESC";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id' => $produtoId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function movimentarCompleta($dados)
    {
        $pdo = Database::conectar();

        $stmt = $pdo->prepare("SELECT prod_estoque FROM produtos WHERE id = :id");
        $stmt->execute([':id' => $dados['produto_id']]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$produto) return false;

        $estoqueAtual = $produto['prod_estoque'];

        if ($dados['tipo'] === 'entrada') {
            $novoEstoque = $estoqueAtual + $dados['quantidade'];
        } else {

            if ($dados['quantidade'] > $estoqueAtual) {
                return "erro_estoque";
            }

            $novoEstoque = $estoqueAtual - $dados['quantidade'];
        }

        $pdo->beginTransaction();

        try {

            $stmt1 = $pdo->prepare("
                UPDATE produtos 
                SET prod_estoque = :estoque 
                WHERE id = :id
            ");

            $stmt1->execute([
                ':estoque' => $novoEstoque,
                ':id' => $dados['produto_id']
            ]);

            $stmt2 = $pdo->prepare("
                INSERT INTO mov_estoque
                (produto_id, move_tipo, move_quantidade, move_observacao)
                VALUES (:produto_id, :tipo, :quantidade, :observacao)
            ");

            $stmt2->execute([
                ':produto_id' => $dados['produto_id'],
                ':tipo' => $dados['tipo'],
                ':quantidade' => $dados['quantidade'],
                ':observacao' => $dados['observacao']
            ]);

            $pdo->commit();

            return true;

        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
}