# API L2JDB - API para MMORPG

API RESTful para gerenciamento de contas e personagens de um servidor MMORPG.

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

### Contas

- `POST /api/v1/accounts` - Criar nova conta
- `POST /api/v1/accounts/login` - Login
- `GET /api/v1/accounts` - Listar contas

### Personagens

- `POST /api/v1/characters` - Criar personagem
- `GET /api/v1/characters/{id}` - Ver detalhes do personagem
- `GET /api/v1/accounts/{accountName}/characters` - Listar personagens da conta

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
