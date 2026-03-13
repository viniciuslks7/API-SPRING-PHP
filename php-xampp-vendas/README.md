# PHP + XAMPP — Sistema de Vendas

Aplicação PHP que consome a API REST Spring Boot de vendas.
Suporta **CRUD completo para todas as 13 entidades** da API, com
menu de navegação, dropdowns de FK e tratamento de chave composta.

## Estrutura dos arquivos

```
php-xampp-vendas/
├── api_functions.php   # Cliente HTTP centralizado (cURL) — define API_BASE
├── config.php          # Configuração das 13 entidades (campos, FKs, labels)
├── layout.php          # Template HTML reutilizável (head, nav, footer)
├── index.php           # Listagem genérica — parâmetro ?recurso=sexos
└── cadastro.php        # Formulário genérico — parâmetro ?recurso=sexos&id=1
```

## Como rodar no XAMPP

1. **Copie** a pasta para o htdocs do XAMPP:
   ```
   C:\xampp\htdocs\php-xampp-vendas\
   ```

2. **Inicie** no XAMPP: **Apache**

3. **Garanta** que a API Spring Boot está rodando em `http://localhost:8090`

   Para subir a API (na raiz do projeto):
   ```
   ./mvnw spring-boot:run
   ```

4. **Acesse** no navegador:
   ```
   http://localhost/php-xampp-vendas/index.php
   ```

## Entidades suportadas

| Grupo         | Entidades                                           |
|---------------|-----------------------------------------------------|
| Tabelas Base  | Sexos, Ruas, Bairros, UFs, Cidades, CEPs            |
| Produtos      | Tipos, Marcas, Fornecedores, Produtos               |
| Vendas        | Clientes, Compras, Itens de Compra (compra-produtos)|

## Observações

- A aplicação PHP **não acessa banco de dados diretamente** — consome apenas a API via cURL.
- Campos FK são exibidos como `<select>` populados via chamadas à API.
- A entidade **compra-produtos** usa chave composta (`codcompra` + `codproduto`).
- Para alterar o host/porta da API, edite `API_BASE` em `api_functions.php`.


- Este exemplo CRUD esta configurado para o endpoint `sexos`.
- A API base esta em `api_functions.php` (`$baseUrl`).
- Se quiser, posso gerar agora as paginas PHP para os outros recursos tambem (`ruas`, `bairros`, `ufs`, etc.).