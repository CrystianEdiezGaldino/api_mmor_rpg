# API MMORPG

API para sistema de MMORPG com autenticação e gerenciamento de personagens.

## Estrutura do Banco de Dados

### Tabela: auth_tokens

Tabela responsável pelo gerenciamento de tokens de autenticação.

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | bigint | ID único do token (auto-incremento) |
| account_name | varchar(45) | Nome da conta associada ao token |
| token | varchar(64) | Token de autenticação (único) |
| expires_at | timestamp | Data de expiração do token |
| is_revoked | boolean | Indica se o token foi revogado |
| created_at | timestamp | Data de criação do registro |
| updated_at | timestamp | Data da última atualização |

**Chaves e Índices:**
- Primary Key: `id`
- Foreign Key: `account_name` referencia `accounts.login`
- Unique Index: `token`

**Comportamento:**
- Quando uma conta faz login, todos os tokens anteriores são revogados
- Tokens expiram após 7 dias
- Tokens revogados não podem ser reutilizados

**Query de Criação:**
```sql
CREATE TABLE `auth_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_revoked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_tokens_token_unique` (`token`),
  KEY `auth_tokens_account_name_foreign` (`account_name`),
  CONSTRAINT `auth_tokens_account_name_foreign` FOREIGN KEY (`account_name`) REFERENCES `accounts` (`login`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

## Requisitos

- PHP 8.1 ou superior
- Composer
- MySQL 5.7 ou superior
- Laravel 10.x

## Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/api_mmor_rpg.git
cd api_mmor_rpg
```

2. Instale as dependências:
```bash
composer install
```

3. Configure o arquivo .env:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure as variáveis de ambiente no arquivo .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. Execute as migrações:
```bash
php artisan migrate
```

6. Inicie o servidor:
```bash
php artisan serve
```

## Endpoints da API

### Autenticação

#### POST /api/v1/accounts/login
```json
{
    "login": "string",
    "password": "string (MD5)"
}
```

#### POST /api/v1/accounts/logout
- Requer token de autenticação no header

### Personagens

#### GET /api/v1/accounts/{accountName}/characters
- Requer token de autenticação no header
- Retorna lista de personagens da conta

## Headers de Autenticação

Para endpoints que requerem autenticação, incluir o header:
```
Authorization: Bearer {token}
```

## Segurança

- Senhas são armazenadas em MD5
- Tokens são gerados usando `Str::random(64)`
- Tokens expiram após 7 dias
- Tokens são revogados no logout
- Apenas um token ativo por conta

## Documentação

A documentação completa da API está disponível em `/home` após iniciar o servidor.

## Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request

## Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
