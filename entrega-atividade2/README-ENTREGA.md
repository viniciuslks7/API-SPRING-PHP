# Entrega Atividade 2 - API Spring + PHP (XAMPP)

## Conteudo
- `api-vendas-spring/`: backend Spring Boot atualizado
- `web-vendas-php/`: aplicacao web PHP que consome a API
- `vendas-api.postman_collection.json`: colecao Postman
- `estrutura-vendasfatec.sql`: estrutura completa do banco (schema)
- `estrutura-vendasfatec-resumo.md`: resumo das tabelas
- `api-vendas-spring.zip`: compactado do backend
- `web-vendas-php.zip`: compactado do frontend

## Execucao rapida
1. Criar banco PostgreSQL `vendasfatec`.
2. Se quiser criar tudo via script, execute `estrutura-vendasfatec.sql` no PostgreSQL.
3. Ajustar `api-vendas-spring/src/main/resources/application.properties` se necessario.
4. Rodar backend: `mvnw.cmd spring-boot:run`.
5. Copiar `web-vendas-php` para `htdocs` do XAMPP.
6. Acessar no navegador a pasta do projeto PHP.

## Observacao
- API padrao: `http://localhost:8090`.
- Exclusao de `compra-produtos` e `produtos` validada.
