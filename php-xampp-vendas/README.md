# PHP + XAMPP - Sistema de Vendas

Aplicacao PHP que consome a API REST Spring Boot de vendas.
Suporta CRUD para as 13 entidades, com menu lateral, telas de listagem e formulario generico.

## Estrutura

```
php-xampp-vendas/
|- api_functions.php   # Cliente HTTP (cURL) e API_BASE
|- config.php          # Definicao das entidades/campos/FKs
|- layout.php          # Head + sidebar + footer compartilhados
|- dashboard.php       # Painel inicial
|- index.php           # Listagem generica (?recurso=...)
|- cadastro.php        # Cadastro/edicao generico
|- style.css           # Estilos da interface
```

## Como rodar no XAMPP

1. Copie a pasta para:
   `C:\xampp\htdocs\php-xampp-vendas\`
2. Inicie o Apache no XAMPP.
3. Garanta a API Spring Boot ativa em `http://localhost:8090`.
4. Acesse:
   `http://localhost/php-xampp-vendas/dashboard.php`

## Observacoes

- A aplicacao PHP nao acessa o banco diretamente: tudo passa pela API.
- Campos FK sao populados por chamadas GET da API.
- `compra-produtos` usa chave composta (`codcompra` + `codproduto`).
- Para mudar host/porta da API, ajuste `API_BASE` em `api_functions.php`.
