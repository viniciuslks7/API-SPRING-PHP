# Entrega Atividade 2 - API Spring + PHP (XAMPP)

## Conteudo
- `api-vendas-spring/`: backend Spring Boot atualizado
- `web-vendas-php/`: aplicacao web PHP que consome a API
- `vendas-api.postman_collection.json`: colecao Postman
- `api-vendas-spring.zip`: compactado do backend
- `web-vendas-php.zip`: compactado do frontend

## Execucao rapida
1. Criar banco PostgreSQL `vendasfatec`.
2. Ajustar `api-vendas-spring/src/main/resources/application.properties` se necessario.
3. Rodar backend: `mvnw.cmd spring-boot:run`.
4. Copiar `web-vendas-php` para `htdocs` do XAMPP.
5. Acessar no navegador a pasta do projeto PHP.

## Observacao
- API padrao: `http://localhost:8090`.
- Exclusao de `compra-produtos` e `produtos` validada.
