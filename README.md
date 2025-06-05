# API de Autenticação e Posts

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=flat&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Docker-Ready-2496ED?style=flat&logo=docker" alt="Docker">
  <img src="https://img.shields.io/badge/API-REST-009688?style=flat" alt="REST API">
</p>

## 📋 Descrição

API REST desenvolvida em Laravel que oferece sistema completo de autenticação de usuários e CRUD de posts. A aplicação utiliza Laravel Sanctum para autenticação baseada em tokens, proporcionando segurança e flexibilidade para aplicações frontend.

### ✨ Funcionalidades

- 🔐 **Autenticação completa**: Registro, login e logout de usuários
- 📝 **CRUD de Posts**: Criação, leitura, atualização e exclusão de postagens
- 🛡️ **Rotas protegidas**: Sistema de middleware para proteção de endpoints sensíveis
- 🔑 **Autenticação por token**: Utilizando Laravel Sanctum
- 🐳 **Docker**: Ambiente containerizado para desenvolvimento

## 🛠️ Tecnologias

| Tecnologia | Descrição |
|------------|-----------|
| **Laravel** | Framework PHP para desenvolvimento web |
| **PHP** | Linguagem de programação |
| **Laravel Sanctum** | Sistema de autenticação por token |
| **MySQL** | Sistema de gerenciamento de banco de dados |
| **Docker** | Containerização da aplicação |
| **Laravel Sail** | Ambiente de desenvolvimento Docker para Laravel |

## 📋 Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

- [Docker](https://www.docker.com/) (versão 20.x ou superior)
- [Docker Compose](https://docs.docker.com/compose/) (geralmente incluído com Docker Desktop)
- [Git](https://git-scm.com/) para clonagem do repositório

## 🚀 Instalação

### 1. Clonando o repositório

**Opção SSH (recomendada):**
```bash
git clone git@github.com:c-rocha7/noweb-laravel.git
cd noweb-laravel
```

**Opção HTTPS:**
```bash
git clone https://github.com/c-rocha7/noweb-laravel.git
cd noweb-laravel
```

### 2. Configuração do ambiente

Copie o arquivo de exemplo das variáveis de ambiente:
```bash
cp .env.example .env
```

**Edite o arquivo `.env` com suas configurações:**
```env
APP_NAME="API Posts"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### 3. Instalação das dependências

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Construção e inicialização do ambiente

**Construir os containers:**
```bash
./vendor/bin/sail build --no-cache
```

**Iniciar os serviços:**
```bash
./vendor/bin/sail up -d
```

### 5. Configuração da aplicação

**Gerar chave da aplicação:**
```bash
./vendor/bin/sail artisan key:generate
```

**Executar migrações:**
```bash
./vendor/bin/sail artisan migrate:fresh
```

**Opcional - Executar seeders (se disponíveis):**
```bash
./vendor/bin/sail artisan db:seed
```

## 🌐 Acesso à Aplicação

A API estará disponível nos seguintes endereços:
- **Local**: [http://localhost](http://localhost)
- **IP**: [http://127.0.0.1](http://127.0.0.1)

## 📚 Documentação da API

### Endpoints de Autenticação

#### Registro de Usuário
```http
POST /api/register
Content-Type: application/json

{
    "name": "João Silva",
    "email": "joao@example.com",
    "password": "senha123",
    "password_confirmation": "senha123"
}
```

#### Login
```http
POST /api/login
Content-Type: application/json

{
    "email": "joao@example.com",
    "password": "senha123"
}
```

#### Logout (Autenticado)
```http
POST /api/logout
Authorization: Bearer {seu_token_aqui}
```

#### Dados do Usuário (Autenticado)
```http
GET /api/user
Authorization: Bearer {seu_token_aqui}
```

### Endpoints de Posts

#### Listar Posts (Público)
```http
GET /api/posts
```

#### Visualizar Post (Público)
```http
GET /api/posts/{id}
```

#### Criar Post (Autenticado)
```http
POST /api/posts
Authorization: Bearer {seu_token_aqui}
Content-Type: application/json

{
    "title": "Título do Post",
    "content": "Conteúdo do post..."
}
```

#### Atualizar Post (Autenticado)
```http
PUT /api/posts/{id}
Authorization: Bearer {seu_token_aqui}
Content-Type: application/json

{
    "title": "Título Atualizado",
    "content": "Conteúdo atualizado..."
}
```

#### Deletar Post (Autenticado)
```http
DELETE /api/posts/{id}
Authorization: Bearer {seu_token_aqui}
```

## 🔧 Comandos Úteis

**Parar os serviços:**
```bash
./vendor/bin/sail down
```

**Ver logs da aplicação:**
```bash
./vendor/bin/sail logs
```

**Executar comandos Artisan:**
```bash
./vendor/bin/sail artisan [comando]
```

**Executar testes:**
```bash
./vendor/bin/sail test
```

**Acessar container da aplicação:**
```bash
./vendor/bin/sail shell
```

## 🐛 Resolução de Problemas

### Porta já em uso
Se a porta 80 estiver ocupada, altere no arquivo `docker-compose.yml`:
```yaml
ports:
    - "8080:80"  # Usar porta 8080 em vez de 80
```

### Problemas de permissão
```bash
sudo chown -R $USER:$USER .
```

### Limpar cache da aplicação
```bash
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan route:clear
```

## 📝 Estrutura do Projeto

```
📦 noweb-laravel
├── 📁 app/
│   ├── 📁 Http/Controllers/
│   │   ├── AuthController.php
│   │   └── PostController.php
│   └── 📁 Models/
├── 📁 database/
│   └── 📁 migrations/
├── 📁 routes/
│   └── api.php
├── 📄 .env.example
├── 📄 composer.json
├── 📄 docker-compose.yml
└── 📄 README.md
```

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
