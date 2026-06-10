# Sistema de Controle de Estoque PHP 

Sistema web de gerenciamento de estoque desenvolvido em PHP utilizando arquitetura MVC (Model-View-Controller) e banco de dados MySQL.

O sistema permite cadastrar produtos, controlar entradas e saídas de estoque, acompanhar histórico de movimentações e realizar pesquisas avançadas através de filtros.

## Funcionalidades

### Produtos
- Cadastro de produtos
- Edição de produtos
- Exclusão de produtos
- Pesquisa por nome
- Pesquisa por categoria
- Pesquisa por preço
- Pesquisa por quantidade em estoque

### Estoque
- Entrada de estoque
- Saída de estoque
- Validação de estoque insuficiente
- Atualização automática do saldo em estoque
- Histórico completo de movimentações

### Organização
- Arquitetura MVC
- Separação entre Controllers, Models e Views
- Utilização de PDO para acesso ao banco de dados
- Rotas amigáveis através do parâmetro `url`

---

## Tecnologias Utilizadas

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- PDO
- Apache
- XAMPP

---

## Estrutura do Projeto

```text
app/
├── controllers/
│   └── ProdutoController.php
│
├── models/
│   └── Produto.php
│
├── views/
│   └── produtos/
│       ├── cadastro.php
│       ├── editar.php
│       ├── historico.php
│       ├── listar.php
│       ├── listagem.php
│       └── movimentar.php
│
└── config/
    └── database.php

public/
├── css/
├── js/
├── image/
└── index.php

routes/
└── web.php

.htaccess
```

---

## Instalação

### 1. Clone o projeto

```bash
git clone https://github.com/seu-usuario/dw-sistema.git
```

### 2. Mova para a pasta do XAMPP

```text
xampp/htdocs/seuprojeto
```

### 3. Crie o banco de dados MySQL

Configure o banco de dados e atualize as credenciais em:

```php
app/config/database.php
```

### 4. Inicie o Apache e o MySQL

Abra o XAMPP Control Panel e inicie:

- Apache
- MySQL

---

## Acesso

Página principal:

```text
http://localhost/seuprojeto/public/?url=produtos
```

Listagem de produtos:

```text
http://localhost/seuprojeto/public/?url=listar-produtos
```

---

## Fluxo de Estoque

1. Cadastro do produto
2. Definição do estoque inicial
3. Movimentação de entrada ou saída
4. Atualização automática do estoque
5. Registro da movimentação no histórico

---

## Próximas Funcionalidades

- Cadastro de clientes
- Cadastro de fornecedores
- Controle de vendas
- Dashboard
- Relatórios em PDF
- Controle financeiro
- Sistema de usuários e permissões

---

## Autor

Desenvolvido por Davi Santos.
