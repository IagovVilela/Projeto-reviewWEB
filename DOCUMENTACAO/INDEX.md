# 📚 Índice da Documentação - Plataforma de Reviews

## 🎯 Documentação Principal

### 📖 [README.md](./README.md)
**Documentação principal do projeto**
- Visão geral da aplicação
- Instalação completa
- Estrutura do projeto
- Comandos úteis
- Links para outras documentações

### ⚡ [INICIO_RAPIDO.md](./INICIO_RAPIDO.md)
**Guia de início rápido para usuários**
- Instalação em 5 minutos
- Soluções para problemas comuns
- Comandos essenciais

## 📁 Documentação Detalhada

### 🔧 [DOCUMENTACAO/TROUBLESHOOTING.md](./DOCUMENTACAO/TROUBLESHOOTING.md)
**Guia completo de resolução de problemas**
- Problemas mais comuns
- Soluções passo a passo
- Comandos de diagnóstico
- Prevenção de problemas

### 🗄️ [DOCUMENTACAO/MYSQL_SETUP.md](./DOCUMENTACAO/MYSQL_SETUP.md)
**Configuração completa do MySQL**
- Instalação em Windows/Linux/Mac
- Configuração de segurança
- Backup e restore
- Otimizações de performance

### 🚀 [DOCUMENTACAO/DEPLOY.md](./DOCUMENTACAO/DEPLOY.md)
**Guia de deploy em produção**
- Deploy em Linux (Ubuntu)
- Deploy em Windows Server
- Configurações de segurança
- Monitoramento e backup

### 👨‍💻 [DOCUMENTACAO/DESENVOLVIMENTO.md](./DOCUMENTACAO/DESENVOLVIMENTO.md)
**Guia para desenvolvedores**
- Arquitetura da aplicação
- Convenções de código
- Testes (PHP e React)
- Fluxo de desenvolvimento

## 🎯 Por Onde Começar?

### 👤 **Sou Usuário Final**
1. Leia: [INICIO_RAPIDO.md](./INICIO_RAPIDO.md)
2. Se der problema: [TROUBLESHOOTING.md](./DOCUMENTACAO/TROUBLESHOOTING.md)
3. Para configuração completa: [README.md](./README.md)

### 🔧 **Sou Administrador de Sistema**
1. Leia: [README.md](./README.md)
2. Configure MySQL: [MYSQL_SETUP.md](./DOCUMENTACAO/MYSQL_SETUP.md)
3. Para deploy: [DEPLOY.md](./DOCUMENTACAO/DEPLOY.md)

### 👨‍💻 **Sou Desenvolvedor**
1. Leia: [DESENVOLVIMENTO.md](./DOCUMENTACAO/DESENVOLVIMENTO.md)
2. Configure ambiente: [README.md](./README.md)
3. Para problemas: [TROUBLESHOOTING.md](./DOCUMENTACAO/TROUBLESHOOTING.md)

## 📋 Checklist de Instalação

### ✅ Pré-requisitos
- [ ] PHP 8.0+ instalado
- [ ] Composer instalado
- [ ] Node.js 18+ instalado
- [ ] MySQL 8.0+ instalado e rodando
- [ ] Git instalado (opcional)

### ✅ Configuração
- [ ] Projeto baixado/clonado
- [ ] Dependências PHP instaladas (`composer install`)
- [ ] Dependências Node.js instaladas (`npm install`)
- [ ] Arquivo `.env` configurado
- [ ] Banco de dados criado
- [ ] Migrações executadas (`php artisan migrate`)
- [ ] Seeders executados (`php artisan db:seed`)

### ✅ Teste
- [ ] Servidor Laravel rodando (`php artisan serve`)
- [ ] Servidor React rodando (`npm run dev`)
- [ ] Frontend acessível em http://localhost:5173
- [ ] Backend acessível em http://localhost:8000
- [ ] Login funcionando (admin@example.com / password)

## 🆘 Suporte Rápido

### Problemas Mais Comuns

| Problema | Solução Rápida |
|----------|----------------|
| Script .bat não funciona | Execute como Administrador |
| Erro de conexão com banco | Verifique se MySQL está rodando |
| Porta já em uso | Use portas diferentes (8001, 5174) |
| Dependências não instaladas | Execute `composer install` e `npm install` |
| Erro de permissões | Configure permissões do Laravel |

### Comandos de Emergência

```bash
# Reset completo (CUIDADO: apaga dados)
rm -rf vendor node_modules storage/logs/*
composer install
npm install
php artisan migrate:fresh --seed

# Verificar status
php artisan about
php artisan migrate:status
npm list
```

## 📞 Contato e Suporte

### Antes de Pedir Ajuda
1. ✅ Consulte a documentação relevante
2. ✅ Execute os comandos de diagnóstico
3. ✅ Verifique os logs de erro
4. ✅ Teste em ambiente limpo

### Informações para Incluir
- Sistema operacional e versão
- Versões do PHP, Composer, Node.js, MySQL
- Mensagem de erro completa
- Logs relevantes
- Passos que levaram ao erro

---

**📚 Esta documentação é mantida atualizada. Sempre consulte a versão mais recente!**
