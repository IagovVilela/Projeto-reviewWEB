# 📧 Exportação Automática de Contatos por E-mail

## ✅ Implementado

A funcionalidade de exportação automática de contatos por e-mail foi implementada com sucesso!

## 📋 Funcionalidades

### 1. Comando Artisan
- **Comando:** `php artisan reviews:send-contacts-export`
- **Opções:**
  - `--period=weekly` - Período (daily, weekly, monthly)
  - `--company=ID` - Exportar apenas uma empresa específica
  - `--test=email@exemplo.com` - Enviar para e-mail de teste

### 2. Agendamento Automático
- **Semanal:** Toda segunda-feira às 9:00 (configurado)
- **Diário:** Opcional (descomente no `Kernel.php`)
- **Mensal:** Opcional (descomente no `Kernel.php`)

### 3. E-mail Enviado
- Assunto: "📊 Relatório [Período] de Contatos - [Nome da Empresa]"
- Anexo: Arquivo CSV com todos os contatos
- Conteúdo: Resumo com estatísticas

## 🚀 Como Usar

### Execução Manual

```bash
# Exportação semanal (últimos 7 dias)
php artisan reviews:send-contacts-export --period=weekly

# Exportação diária (hoje)
php artisan reviews:send-contacts-export --period=daily

# Exportação mensal (último mês)
php artisan reviews:send-contacts-export --period=monthly

# Exportar apenas uma empresa
php artisan reviews:send-contacts-export --company=1

# Testar enviando para outro e-mail
php artisan reviews:send-contacts-export --test=seu-email@teste.com
```

### Configurar Agendamento Automático

O agendamento já está configurado em `app/Console/Kernel.php`:

```php
// Semanal (ativo)
$schedule->command('reviews:send-contacts-export --period=weekly')
         ->weeklyOn(1, '9:00')
         ->timezone('America/Sao_Paulo');
```

Para ativar outros períodos, descomente as linhas no `Kernel.php`.

### Executar o Schedule

No servidor, configure o cron:

```bash
* * * * * cd /caminho/para/projeto && php artisan schedule:run >> /dev/null 2>&1
```

Ou no Windows com Task Scheduler, execute:
```
php artisan schedule:run
```
a cada minuto.

## 📊 Conteúdo do CSV

O arquivo CSV contém:
- **Data** - Data e hora da avaliação
- **Nota** - Estrelas atribuídas (1-5)
- **WhatsApp** - Número do WhatsApp do cliente
- **Comentário** - Comentário público (se houver)
- **Feedback** - Feedback privado (para avaliações negativas)
- **Tipo** - Positiva ou Negativa

## 📧 E-mail Enviado

O e-mail contém:
- Logo da empresa (se configurado)
- Resumo de estatísticas:
  - Total de contatos
  - Avaliações positivas vs negativas
  - Nota média
- Anexo CSV com todos os dados

## ⚙️ Configuração

### Destinatário do E-mail
O e-mail é enviado para o campo `negative_email` da empresa.

### Períodos Disponíveis
- **daily/day** - Últimas 24 horas
- **weekly/week** - Últimos 7 dias (padrão)
- **monthly/month** - Últimos 30 dias

## 🧪 Testar

```bash
# Testar com uma empresa específica
php artisan reviews:send-contacts-export --company=1 --test=seu-email@teste.com

# Verificar se o comando está registrado
php artisan list | grep reviews
```

## 📝 Arquivos Criados

1. `app/Mail/ContactsExport.php` - Classe Mailable
2. `app/Console/Commands/SendContactsExport.php` - Comando Artisan
3. `resources/views/emails/contacts-export.blade.php` - Template do e-mail
4. `app/Console/Kernel.php` - Agendamento (atualizado)

## ✅ Status

- ✅ Mailable criado
- ✅ Command criado
- ✅ Template de e-mail criado
- ✅ Agendamento configurado
- ✅ Geração de CSV implementada
- ✅ Limpeza automática de arquivos temporários

## 🎯 Próximos Passos

1. Testar o comando manualmente
2. Configurar cron no servidor (se em produção)
3. Ajustar horários no `Kernel.php` conforme necessário
4. Monitorar logs para garantir envio correto


