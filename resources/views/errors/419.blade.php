<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesión expirada</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}"> 
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .error-container h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #c0392b;
        }
        .error-container a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .error-container a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Error 419 - Sesión expirada</h1>
        <p>La sesión ha expirado o el formulario ya fue enviado.</p>
        <a href="{{ route('bibliotecario.login.form') }}">Volver al inicio de sesión</a>
    </div>
</body>
</html>
