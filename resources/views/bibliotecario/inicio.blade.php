<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Dashboard</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <header class="header">
    <div class="container header-content">
      <div class="logo">Biblioteca Estudiantil</div>
      <nav class="nav">
        <a href="#" class="nav-link">Cerrar Sesión</a>
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
      <h1 class="section-title">Bienvenido "Nombre del bibliotecario"</h1>
      
      <div class="card">
        <h2>Resumen del sistema</h2>
        <p>Aquí irían estadísticas o información relevante sobre préstamos, devoluciones, etc.</p>
      </div>
    </main>
  </div>
</body>
</html>