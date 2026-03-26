# API Spring + PHP (Atividade 2)

Projeto da disciplina **Arquitetura Orientada a Servicos (FATEC)** para a **Atividade 2 (2026)**.

## Objetivo

Implementar API REST com Spring Boot para o banco `vendasfatec` e consumir os endpoints em uma aplicacao web PHP (XAMPP).

## Arquitetura

Backend em camadas:
- `models` (entidades JPA)
- `repositories` (Spring Data)
- `services` (regra/operacoes)
- `controllers` (endpoints REST)

Entidades cobertas:
- Base: `sexo`, `rua`, `bairro`, `uf`, `cidade`, `cep`, `tipo`, `marca`
- Relacionadas: `cliente`, `fornecedor`, `produto`, `compra`, `compra-produto`

## Backend (Spring Boot)

Requisitos:
- Java 17+
- Maven Wrapper (`mvnw`)
- PostgreSQL (ajuste em `src/main/resources/application.properties`)

Subir API:

```bash
./mvnw spring-boot:run
```

A API roda em:
- `http://localhost:8090`

## Frontend (PHP + XAMPP)

Pasta:
- `php-xampp-vendas`

Passos:
1. Copiar para `C:\xampp\htdocs\php-xampp-vendas`
2. Iniciar Apache no XAMPP
3. Garantir API Spring ativa em `http://localhost:8090`
4. Abrir `http://localhost/php-xampp-vendas/dashboard.php`

## Postman

Colecao em:
- `postman/vendas-api.postman_collection.json`

Configurar variavel:
- `baseUrl = http://localhost:8090`

## Observacoes de exclusao

Remocoes agora validam status HTTP da API.
- Exclusao bem-sucedida -> feedback de sucesso
- Registro referenciado (FK) -> feedback de erro (conflito)

