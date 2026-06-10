<?php

$url = $_GET['url'] ?? '';

require_once __DIR__ . '/../app/controllers/ProdutoController.php';

$controller = new ProdutoController();

switch ($url) {

    case 'produtos':
        $controller->index();
        break;

    case 'listar-produtos':
        $controller->listar();
        break;

    case 'editar-produto':
        $controller->editar();
        break;

    case 'movimentar-estoque':
    $controller->movimentar();
    break;

    case 'excluir-produto':
    $controller->excluir();
    break;

    case 'historico-estoque':
    $controller->historicoEstoque();
    break;

    default:
        echo "Página Inicial";
        break;
}

