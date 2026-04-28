# To-Do App - Gestor de Tarefas

Uma aplicação web moderna e intuitiva para gestão de tarefas, desenvolvida com **Laravel 12**, **Vue 3** e **Tailwind CSS**.

## 🎯 Funcionalidades

✅ **CRUD de Tarefas** - Criar, ler, atualizar e excluir tarefas  
✅ **Filtros Avançados** - Por estado, prioridade e data de vencimento  
✅ **Edição Modal** - Interface amigável para editar tarefas  
✅ **Notificações** - Feedback visual de sucesso e erro  
✅ **Design Responsivo** - Funciona perfeitamente em qualquer dispositivo  
✅ **Segurança** - Autenticação e autorização com policies  
✅ **Testes Automatizados** - Cobertura de testes unitários e de integração  

## 🚀 Quick Start

### Pré-requisitos
- PHP 8.2+
- Node.js 18+
- MySQL 8+
- Composer

### Instalação

```bash
# 1. Clonar repositório
git clone <repository-url>
cd To-Do

# 2. Instalar dependências PHP
composer install

# 3. Instalar dependências Node.js
npm install

# 4. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 5. Executar migrations
php artisan migrate

# 6. Iniciar servidores (em terminais separados)
php artisan serve          # Terminal 1
npm run dev                # Terminal 2
```

Acesse: `http://localhost:8000`

## 📊 Estrutura do Projeto

```
To-Do/
├── app/
│   ├── Models/Task.php
│   ├── Http/Controllers/TaskController.php
│   └── Policies/TaskPolicy.php
├── database/
│   ├── migrations/
│   └── factories/TaskFactory.php
├── resources/
│   ├── js/components/
│   │   ├── ToDoApp.vue
│   │   ├── TaskForm.vue
│   │   ├── TaskList.vue
│   │   ├── TaskEditModal.vue
│   │   └── NotificationToast.vue
│   ├── css/app.css
│   └── views/welcome.blade.php
├── routes/
│   ├── web.php
│   └── tasks.php
├── tests/
│   ├── Feature/TaskTest.php
│   └── Unit/TaskModelTest.php
└── DOCUMENTATION.md
```

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Testes com coverage
php artisan test --coverage

# Testes específicos
php artisan test tests/Feature/TaskTest.php
```

## 🛠️ Desenvolvimento

### Scripts Disponíveis

```bash
npm run dev      # Iniciar Vite dev server
npm run build    # Build para produção
php artisan test # Executar testes
php artisan migrate # Executar migrations
```

## 📚 Documentação Completa

Consulte [DOCUMENTATION.md](./DOCUMENTATION.md) para:
- Arquitetura detalhada
- Especificação de API
- Guia de contribuição
- Melhorias futuras

## 🔐 Segurança

- ✓ Validação de dados no backend
- ✓ Autenticação obrigatória
- ✓ Autorização por policies
- ✓ Proteção contra CSRF
- ✓ SQL injection prevention

## 📱 Responsividade

- 📱 Mobile (320px+)
- 📱 Tablet (768px+)
- 💻 Desktop (1024px+)

## 🌐 Tecnologias

| Camada | Tecnologia |
|--------|-----------|
| Backend | Laravel 12 |
| Frontend | Vue 3 |
| Estilização | Tailwind CSS 4 |
| Build | Vite |
| Testes | Pest |
| Database | MySQL 8 |

## 📝 Estrutura de Commit

Seguimos [Conventional Commits](https://www.conventionalcommits.org/):

```
feat: adicionar nova funcionalidade
fix: corrigir bug
docs: atualizar documentação
test: adicionar testes
refactor: refatorar código
```

## 🤝 Contribuição

1. Fork o repositório
2. Crie uma branch (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'feat: adicionar feature incrível'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT.

## 👥 Autor

Desenvolvido como parte do projeto Inovcorp To-Do.

## 📧 Suporte

Para suporte, abra uma issue no repositório.

---

**Versão:** 1.0.0  
**Última Atualização:** Abril 2026

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
