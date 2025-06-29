<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Circulación</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <header class="header">
    <div class="container header-content">
      <div class="logo">Biblioteca Estudiantil</div>
      <nav class="nav">
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="nav-link" style="background:none; border:none; cursor:pointer;">
      Cerrar Sesión
    </button>
  </form>
</nav>
    </div>
  </header>
  
  <div class="container sidebar-layout">
  <aside class="sidebar">
    <ul class="sidebar-menu">
      <li class="sidebar-item">
        <a href="{{ url('bibliotecario/inicio') }}" class="sidebar-link">Inicio</a>
      </li>
      <li class="sidebar-item">
        <a href="{{ url('bibliotecario/miembros') }}" class="sidebar-link">Miembros</a>
      </li>
      <li class="sidebar-item">
        <a href="{{ url('bibliotecario/circulacion') }}" class="sidebar-link">Circulación</a>
      </li>
      <li class="sidebar-item">
        <a href="{{ url('bibliotecario/catalogo') }}" class="sidebar-link">Catálogo</a>
      </li>
    </ul>
  </aside>
    <main class="main">
      <h1 class="section-title">Circulación</h1>
      
      <div class="card-grid">
        <div class="card card-action">
          <a href="{{ url('bibliotecario/prestamo') }}" class="card-link">
            <div class="card-icon">📚</div>
            <h2 class="card-title">Préstamos</h2>
            <p class="card-description">Gestión de préstamos de materiales</p>
          </a>
        </div>
        
        <div class="card card-action">
          <a href="{{ url('bibliotecario/devolucion') }}" class="card-link">
            <div class="card-icon">↩️</div>
            <h2 class="card-title">Devoluciones</h2>
            <p class="card-description">Registro de devoluciones de materiales</p>
          </a>
        </div>
      </div>
    </main>
  </div>
</body>
</html>