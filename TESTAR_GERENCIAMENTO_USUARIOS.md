# 🧪 Como Testar o Sistema de Gerenciamento de Usuários

## 🚀 Iniciar o Sistema

### 1. Iniciar o Servidor Laravel
```bash
cd reviews-platform
php artisan serve
```
O sistema estará disponível em: `http://localhost:8000`

### 2. Criar Usuário Administrador (Se necessário)
Acesse no navegador:
```
http://localhost:8000/create-admin
```

**Credenciais criadas:**
- Email: `admin@reviewsplatform.com`
- Senha: `admin123`

---

## ✅ Testes Funcionais

### Teste 1: Login como Administrador
1. Acesse: `http://localhost:8000/login`
2. Email: `admin@reviewsplatform.com`
3. Senha: `admin123`
4. Clique em "Entrar"
5. **Resultado esperado**: ✅ Redirecionado para dashboard

### Teste 2: Acessar Gerenciamento de Usuários
1. No menu lateral, procure "CONFIGURAÇÕES"
2. Clique em "Usuários"
3. **Resultado esperado**: ✅ Página com lista de usuários e estatísticas

### Teste 3: Criar Novo Usuário Administrador
1. Clique no botão "Novo Usuário" (roxo, canto superior direito)
2. Preencha:
   - Nome: `Admin Teste`
   - Email: `admin2@teste.com`
   - Função: `Administrador`
   - Senha: `teste123`
   - Confirmar Senha: `teste123`
3. Clique em "Criar Usuário"
4. **Resultado esperado**: ✅ Mensagem de sucesso + usuário na lista

### Teste 4: Criar Novo Usuário Padrão
1. Clique no botão "Novo Usuário"
2. Preencha:
   - Nome: `Usuário Teste`
   - Email: `user@teste.com`
   - Função: `Usuário`
   - Senha: `teste123`
   - Confirmar Senha: `teste123`
3. Clique em "Criar Usuário"
4. **Resultado esperado**: ✅ Mensagem de sucesso + usuário na lista

### Teste 5: Editar Usuário
1. Na lista, localize "Usuário Teste"
2. Clique no botão "Editar" (azul)
3. Altere o nome para: `Usuário Teste Editado`
4. Clique em "Salvar Alterações"
5. **Resultado esperado**: ✅ Nome atualizado na lista

### Teste 6: Alterar Senha de Usuário
1. Na lista, clique em "Editar" em qualquer usuário
2. No campo "Nova Senha", digite: `novasenha123`
3. No campo "Confirmar Nova Senha", digite: `novasenha123`
4. Clique em "Salvar Alterações"
5. **Resultado esperado**: ✅ Senha alterada com sucesso
6. **Verificar**: Faça logout e tente login com a nova senha

### Teste 7: Verificar Proteção - Não Pode Excluir Própria Conta
1. Na lista, localize sua própria conta (deve ter badge "Você")
2. **Resultado esperado**: ✅ Botão "Excluir" NÃO aparece

### Teste 8: Verificar Proteção - Não Pode Excluir Último Admin
1. Se houver apenas 1 administrador
2. Tente excluir esse administrador
3. **Resultado esperado**: ✅ Mensagem de erro "Não é possível excluir o último administrador"

### Teste 9: Excluir Usuário Padrão
1. Na lista, localize "Usuário Teste Editado"
2. Clique no botão "Excluir" (vermelho)
3. Confirme a exclusão no diálogo
4. **Resultado esperado**: ✅ Usuário removido da lista

### Teste 10: Testar Validações - Email Duplicado
1. Clique em "Novo Usuário"
2. Tente criar usuário com email que já existe
3. **Resultado esperado**: ✅ Erro "Email já existe"

### Teste 11: Testar Validações - Senhas Não Coincidem
1. Clique em "Novo Usuário"
2. Digite senhas diferentes nos campos de senha
3. **Resultado esperado**: ✅ Erro "As senhas não coincidem"

### Teste 12: Testar Validações - Senha Curta
1. Clique em "Novo Usuário"
2. Digite uma senha com menos de 6 caracteres
3. **Resultado esperado**: ✅ Erro "Senha deve ter no mínimo 6 caracteres"

### Teste 13: Logout e Login com Novo Usuário
1. Faça logout
2. Tente login com `user@teste.com` / `teste123`
3. **Resultado esperado**: ✅ Login bem-sucedido
4. **Verificar**: Menu "Usuários" NÃO aparece (pois não é admin)

### Teste 14: Tentar Acessar Rota de Usuários Sem Ser Admin
1. Logado como usuário padrão
2. Tente acessar: `http://localhost:8000/users`
3. **Resultado esperado**: ✅ Erro 403 "Acesso negado"

### Teste 15: Verificar Estatísticas no Dashboard
1. Login como admin
2. Acesse "Usuários"
3. Verifique os 3 cartões no topo:
   - Total de Usuários
   - Administradores
   - Usuários Padrão
4. **Resultado esperado**: ✅ Números corretos e atualizados

---

## 🎨 Testes Visuais

### Teste 16: Responsividade - Mobile
1. Abra DevTools (F12)
2. Ative modo responsivo
3. Teste em diferentes tamanhos:
   - iPhone SE (375px)
   - iPad (768px)
   - Desktop (1920px)
4. **Resultado esperado**: ✅ Layout ajusta perfeitamente

### Teste 17: Dark Mode
1. Clique no botão de lua/sol no cabeçalho
2. **Resultado esperado**: ✅ Interface muda para modo escuro
3. Verifique legibilidade e contraste

### Teste 18: Animações
1. Navegue entre páginas
2. Crie/edite usuários
3. **Resultado esperado**: ✅ Transições suaves e animações fluidas

---

## 🔒 Testes de Segurança

### Teste 19: Tentar Acessar sem Autenticação
1. Faça logout
2. Tente acessar: `http://localhost:8000/users`
3. **Resultado esperado**: ✅ Redirecionado para login

### Teste 20: Verificar Hash de Senha
1. No banco de dados, verifique a tabela `users`
2. Coluna `password`
3. **Resultado esperado**: ✅ Senha está hasheada (não está em texto plano)

```sql
SELECT email, password FROM users;
```

### Teste 21: Tentar SQL Injection (Segurança)
1. No formulário de criação
2. No campo email, tente: `' OR '1'='1`
3. **Resultado esperado**: ✅ Validação bloqueia / não causa erro

---

## 📊 Testes de Performance

### Teste 22: Carregar Lista com Muitos Usuários
1. Crie 50+ usuários (pode usar um seeder)
2. Acesse a lista de usuários
3. **Resultado esperado**: ✅ Carrega rápido (< 2 segundos)

### Teste 23: Verificar Consultas ao Banco
1. Ative o debug bar do Laravel
2. Navegue pelas páginas de usuários
3. **Resultado esperado**: ✅ Poucas queries, sem N+1 problem

---

## 🐛 Testes de Erro

### Teste 24: Tentar Editar Usuário Inexistente
1. Acesse: `http://localhost:8000/users/9999/edit`
2. **Resultado esperado**: ✅ Erro 404

### Teste 25: Tentar Excluir Usuário Inexistente
1. Tente excluir ID que não existe
2. **Resultado esperado**: ✅ Erro 404

---

## 📝 Checklist de Testes

Marque conforme for testando:

### Funcionalidades Básicas
- [ ] Login como admin funciona
- [ ] Acesso à página de usuários funciona
- [ ] Criação de usuário admin funciona
- [ ] Criação de usuário padrão funciona
- [ ] Edição de usuário funciona
- [ ] Alteração de senha funciona
- [ ] Exclusão de usuário funciona

### Validações
- [ ] Email duplicado é bloqueado
- [ ] Senhas não correspondentes são bloqueadas
- [ ] Senha curta (< 6 chars) é bloqueada
- [ ] Campos obrigatórios são validados

### Segurança
- [ ] Não pode excluir própria conta
- [ ] Não pode excluir último admin
- [ ] Usuário padrão não acessa rotas de admin
- [ ] Senhas são hasheadas no banco
- [ ] Redirecionamento para login sem auth

### Interface
- [ ] Dashboard de estatísticas funciona
- [ ] Tabela de usuários exibe corretamente
- [ ] Formulários são intuitivos
- [ ] Mensagens de sucesso/erro aparecem
- [ ] Botões funcionam corretamente

### Responsividade
- [ ] Mobile (375px) funciona
- [ ] Tablet (768px) funciona
- [ ] Desktop (1920px) funciona
- [ ] Dark mode funciona

### Performance
- [ ] Páginas carregam rápido
- [ ] Sem queries desnecessárias
- [ ] Animações são fluidas

---

## 🎯 Resultado Esperado Final

Após todos os testes:
- ✅ Todos os testes passam
- ✅ Nenhum erro no console
- ✅ Nenhum erro no log do Laravel
- ✅ Interface responsiva e bonita
- ✅ Sistema seguro e funcional

---

## 🔍 Como Ver os Logs

### Laravel Log
```bash
tail -f storage/logs/laravel.log
```

### Logs do Navegador
1. Abra DevTools (F12)
2. Vá para aba "Console"
3. Verifique erros JavaScript

---

## 📞 Se Algo Não Funcionar

### 1. Limpar Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 2. Verificar Permissões
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 3. Recriar Banco (CUIDADO: apaga dados)
```bash
php artisan migrate:fresh
php artisan db:seed
```

### 4. Verificar .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

---

## 🎉 Testes Bem-Sucedidos?

Se todos os testes passaram:
✅ **Sistema está funcionando perfeitamente!**
✅ **Pronto para uso em produção!**
✅ **Parabéns! 🎊**

---

**Data**: Outubro 2025  
**Versão**: 1.0  
**Status**: ✅ Completo

