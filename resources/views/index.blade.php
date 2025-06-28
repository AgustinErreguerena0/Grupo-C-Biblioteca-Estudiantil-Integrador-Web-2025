<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Estudiantil - Inicio de sesión</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h1 class="login-title">Iniciar sesión</h1>
    
    <form class="card">
      <div class="form-group">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" id="usuario" class="form-control" placeholder="Ingrese su usuario">
      </div>
      
      <div class="form-group">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" id="contrasena" class="form-control" placeholder="Ingrese su contraseña">
      </div>
      
      <button type="submit" class="btn btn-primary w-100">Ingresar</button>
      
      <div class="alert alert-danger mt-3">
        A simple danger alert!
      </div>
    </form>
  </div>
</body>
</html>