<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Préstamo</title>
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
          <a href="inicio.html" class="sidebar-link">Inicio</a>
        </li>
        <li class="sidebar-item">
          <a href="miembros.html" class="sidebar-link">Miembros</a>
        </li>
        <li class="sidebar-item">
          <a href="circulacion.html" class="sidebar-link active">Circulación</a>
        </li>
        <li class="sidebar-item">
          <a href="catalogo.html" class="sidebar-link">Catálogo</a>
        </li>
      </ul>
    </aside>
    
    <main class="main">
      <h1 class="section-title">Préstamo</h1>
      
      <div class="card">
        <h2>Miembro</h2>
        <div class="form-group">
          <label for="dni-miembro" class="form-label">Ingrese el DNI del miembro</label>
          <input type="text" id="dni-miembro" class="form-control">
        </div>
      </div>
      
      <div class="card">
        <h2>Ejemplar</h2>
        <div class="form-group">
          <label for="id-ejemplar" class="form-label">Ingrese el identificador del ejemplar</label>
          <input type="text" id="id-ejemplar" class="form-control">
        </div>
        <button class="btn btn-primary">Agregar</button>
      </div>
      
      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Identificador</th>
              <th>Ubicación</th>
              <th>Título</th>
              <th>Creador</th>
              <th>Asunto</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>EJ001</td>
              <td>Estante A2, Sección Filosofía</td>
              <td>Historia de la Computación</td>
              <td>Juan Pérez</td>
              <td>Computación, Historia</td>
            </tr>
            <tr>
              <td>EJ002</td>
              <td>Estante B1, Sección Historia</td>
              <td>Historia de la Computación</td>
              <td>Juan Pérez</td>
              <td>Computación, Historia</td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <button class="btn btn-primary">Efectuar Préstamo</button>
    </main>
  </div>
</body>
</html>