<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Gestión de Miembros</title>
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
          <a href="miembros.html" class="sidebar-link active">Miembros</a>
        </li>
        <li class="sidebar-item">
          <a href="circulacion.html" class="sidebar-link">Circulación</a>
        </li>
        <li class="sidebar-item">
          <a href="catalogo.html" class="sidebar-link">Catálogo</a>
        </li>
      </ul>
    </aside>
    
    <main class="main">
      <div class="d-flex justify-content-between mb-3">
        <h1 class="section-title">Gestión de Miembros</h1>
        <a href="alta-miembro.html" class="btn btn-primary">Nuevo Miembro</a>
      </div>
      
      <div class="card">
          <!-- Nuevo contenedor .search-bar -->
          <div class="search-bar">
            <input
              type="text"
              class="form-control"
              placeholder="Buscar por nombre, apellido o DNI"
            />

            <button class="btn btn-primary">Buscar</button>
          </div>
        </div>
      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>DNI</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Tipo de Miembro</th>
              <th>Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>María</td>
              <td>González</td>
              <td>30123456</td>
              <td>maria@example.com</td>
              <td>555-1234</td>
              <td>Calle Principal 123</td>
              <td>Estudiante</td>
              <td>mgonzalez</td>
              <td>
                <a href="#" class="icon-btn" title="Ver">👁️</a>
          
                <a href="#" class="icon-btn" title="Eliminar">🗑️</a>
              </td>
            </tr>
            <tr>
              <td>Carlos</td>
              <td>López</td>
              <td>28987654</td>
              <td>carlos@example.com</td>
              <td>555-5678</td>
              <td>Avenida Central 456</td>
              <td>Profesor</td>
              <td>clopez</td>
              <td>
                <a href="#" class="icon-btn" title="Ver">👁️</a>
       
                <a href="#" class="icon-btn" title="Eliminar">🗑️</a>
              </td>
            </tr>
            <tr>
              <td>Ana</td>
              <td>Martínez</td>
              <td>34567890</td>
              <td>ana@example.com</td>
              <td>555-9012</td>
              <td>Boulevard Norte 789</td>
              <td>Estudiante</td>
              <td>amartinez</td>
              <td>
                <a href="#" class="icon-btn" title="Ver">👁️</a>
          
                <a href="#" class="icon-btn" title="Eliminar">🗑️</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>