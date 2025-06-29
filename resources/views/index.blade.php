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
    
    <form class="card" method="POST" action="{{ route('bibliotecario.login') }}">
      @csrf {{-- ¡Importante para seguridad en Laravel! --}}
      
      <div class="form-group">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingrese su usuario" value="{{ old('usuario') }}">
        @error('usuario')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-group">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Ingrese su contraseña">
        @error('contrasena')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
      
      {{-- Mostrar error de autenticación general --}}
      @error('loginError')
          <div class="alert alert-danger mt-3">{{ $message }}</div>
      @enderror

      <button type="submit" class="btn btn-primary w-100">Ingresar</button>
      
    </form>
  </div>
</body>
</html>

