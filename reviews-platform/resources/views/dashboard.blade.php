<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Dashboard - Reviews Platform</title> 
    <style> 
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; } 
        .container { max-width: 1200px; margin: 0 auto; } 
        h1 { color: #333; text-align: center; margin-bottom: 30px; } 
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; } 
        .stat-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; } 
        .stat-number { font-size: 2em; font-weight: bold; color: #007bff; } 
        .stat-label { color: #666; margin-top: 10px; } 
        .btn { display: inline-block; padding: 12px 24px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin: 10px; } 
        .btn:hover { background: #0056b3; } 
        .center { text-align: center; } 
    </style> 
</head> 
<body> 
    <div class="container"> 
        <h1>📊 Dashboard</h1> 
        <div class="stats"> 
            <div class="stat-card"> 
                <div class="stat-number">1</div> 
                <div class="stat-label">Empresas</div> 
            </div> 
            <div class="stat-card"> 
                <div class="stat-number">1</div> 
                <div class="stat-label">Reviews</div> 
            </div> 
            <div class="stat-card"> 
                <div class="stat-number">5.0</div> 
                <div class="stat-label">Avaliação Média</div> 
            </div> 
        </div> 
        <div class="center"> 
            <a href="/" class="btn">Voltar ao início</a> 
            <a href="/login" class="btn">Fazer Login</a> 
        </div> 
    </div> 
</body> 
</html> 
