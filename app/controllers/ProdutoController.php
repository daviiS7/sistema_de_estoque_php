<?php

require_once __DIR__ . '/../models/Produto.php';

class ProdutoController
{
    public function index()
    {
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $dados = [
                'nome' => trim($_POST['nome'] ?? ''),
                'categoria' => $_POST['categoria'] ?? '',
                'codigo_barras' => $_POST['codigo_barras'] ?? '',
                'preco_custo' => trim($_POST['preco_custo'] ?? ''),
                'preco_venda' => trim($_POST['preco_venda'] ?? ''),
                'estoque' => trim($_POST['estoque'] ?? ''),
                'estoque_minimo' => trim($_POST['estoque_minimo'] ?? 0),
                'unidade' => $_POST['unidade'] ?? 'UN'
            ];

            if (
                empty($dados['nome']) ||
                $dados['preco_custo'] === '' ||
                $dados['preco_venda'] === '' ||
                $dados['estoque'] === ''
            ) {
                $erro = "Preencha todos os campos obrigatórios.";
            } else {

                Produto::salvar($dados);

                $_SESSION['sucesso'] = 'Produto cadastrado com sucesso!';

                header('Location: ?url=listar-produtos');
                exit;
            }
        }

        require __DIR__ . '/../views/produtos/cadastro.php';
    }

    public function listar()
    {
        $filtros = [
            'nome' => $_GET['nome'] ?? '',
            'categoria' => $_GET['categoria'] ?? '',
            'operador_preco' => $_GET['operador_preco'] ?? '',
            'valor_preco' => $_GET['valor_preco'] ?? '',
            'operador_estoque' => $_GET['operador_estoque'] ?? '',
            'valor_estoque' => $_GET['valor_estoque'] ?? ''
        ];

        $produtos = Produto::pesquisar($filtros);

        require __DIR__ . '/../views/produtos/listagem.php';
    }

    public function editar()
    {
        $erro = '';
        $id = $_GET['id'] ?? 0;

        $produto = Produto::buscarPorId($id);

        if (!$produto) {
            $_SESSION['erro'] = "Produto não encontrado!";
            header('Location: ?url=listar-produtos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $dados = [
                'id' => $_POST['id'],
                'nome' => trim($_POST['nome'] ?? ''),
                'categoria' => $_POST['categoria'] ?? '',
                'codigo_barras' => $_POST['codigo_barras'] ?? '',
                'preco_custo' => trim($_POST['preco_custo'] ?? ''),
                'preco_venda' => trim($_POST['preco_venda'] ?? ''),
                'estoque' => trim($_POST['estoque'] ?? ''),
                'estoque_minimo' => trim($_POST['estoque_minimo'] ?? 0),
                'unidade' => $_POST['unidade'] ?? 'UN'
            ];

            if (
                empty($dados['nome']) ||
                $dados['preco_custo'] === '' ||
                $dados['preco_venda'] === '' ||
                $dados['estoque'] === ''
            ) {
                $erro = "Preencha todos os campos obrigatórios.";
            } else {

                Produto::atualizar($dados);

                $_SESSION['sucesso'] = 'Produto atualizado com sucesso!';

                header('Location: ?url=listar-produtos');
                exit;
            }
        }

        require __DIR__ . '/../views/produtos/editar.php';
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? 0;

        if (!$id) {
            $_SESSION['erro'] = 'ID inválido!';
            header('Location: ?url=listar-produtos');
            exit;
        }

        Produto::excluir($id);

        $_SESSION['sucesso'] = 'Produto excluído com sucesso!';

        header('Location: ?url=listar-produtos');
        exit;
    }

    public function movimentar()
    {
        $id = $_GET['id'] ?? 0;

        $produto = Produto::buscarPorId($id);

        if (!$produto) {
            $_SESSION['erro'] = 'Produto não encontrado!';
            header('Location: ?url=listar-produtos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $dados = [
                'produto_id' => $id,
                'tipo' => $_POST['tipo'],
                'quantidade' => (int) $_POST['quantidade'],
                'observacao' => $_POST['observacao'] ?? ''
            ];

            if ($dados['quantidade'] <= 0) {
                $_SESSION['erro'] = 'Informe uma quantidade válida!';
                header('Location: ?url=movimentar-estoque&id=' . $id);
                exit;
            }

            $resultado = Produto::movimentarCompleta($dados);

            if ($resultado === "erro_estoque") {
                $_SESSION['erro'] = 'Estoque insuficiente!';
                header('Location: ?url=movimentar-estoque&id=' . $id);
                exit;
            }

            if ($resultado === false) {
                $_SESSION['erro'] = 'Erro ao movimentar estoque!';
                header('Location: ?url=movimentar-estoque&id=' . $id);
                exit;
            }

            $_SESSION['sucesso'] = 'Movimentação realizada com sucesso!';

            header('Location: ?url=historico-estoque&id=' . $id);
            exit;
        }

        require __DIR__ . '/../views/produtos/movimentar.php';
    }

    public function historicoEstoque()
    {
        $id = $_GET['id'] ?? 0;

        $produto = Produto::buscarPorId($id);

        if (!$produto) {
            $_SESSION['erro'] = 'Produto não encontrado!';
            header('Location: ?url=listar-produtos');
            exit;
        }

        $movimentacoes = Produto::historicoMovimentacoes($id);

        require __DIR__ . '/../views/produtos/historico.php';
    }
}

