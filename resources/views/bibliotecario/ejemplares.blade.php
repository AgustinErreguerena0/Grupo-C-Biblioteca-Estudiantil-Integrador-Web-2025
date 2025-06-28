<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Gestión de Ejemplares</title>
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
          <a href="circulacion.html" class="sidebar-link">Circulación</a>
        </li>
        <li class="sidebar-item">
          <a href="catalogo.html" class="sidebar-link active">Catálogo</a>
        </li>
      </ul>
    </aside>
    
    <main class="main">
      <h1 class="section-title">Gestión de Ejemplares</h1>
      
      <div class="card">
        <h2>Historia de la Computación</h2>
        <p>Creator: Juan Pérez | Subject: Computación, Historia</p>
      </div>
      
      <div class="card">
        <h3>Nuevo Ejemplar</h3>
        <form>
          <div class="form-group">
            <label for="identificador" class="form-label">Identificador*</label>
            <input type="text" id="identificador" class="form-control" required>
          </div>
          
          <div class="form-group">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" id="ubicacion" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <select id="disponibilidad" class="form-control">
              <option value="disponible">Disponible</option>
              <option value="no-disponible">No disponible</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="procedencia" class="form-label">Procedencia</label>
            <input type="text" id="procedencia" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="estado" class="form-label">Estado del ejemplar</label>
            <select id="estado" class="form-control">
              <option value="correcto">En correcto estado</option>
              <option value="danio-leve">Daño leve</option>
              <option value="danio-medio">Daño medio</option>
              <option value="indeterminado">Indeterminado</option>
            </select>
          </div>
          
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
      
      <div class="card">
        <h3>Ejemplares existentes</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Identificador</th>
              <th>Ubicación</th>
              <th>Procedencia</th>
              <th>Proveedor</th>
              <th>Estado</th>
              <th>Disponibilidad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>EJ001</td>
              <td>Estante A2, Sección Filosofía</td>
              <td>Compra</td>
              <td>Editorial AliaOmega</td>
              <td>En correcto estado</td>
              <td>Disponible</td>
              <td>
                <a href="#" class="icon-btn" title="Eliminar">🗑️</a>
              </td>
            </tr>
            <tr>
              <td>EJ002</td>
              <td>Estante B1, Sección Historia</td>
              <td>Donación</td>
              <td>Prof. José Ramírez</td>
              <td>Daño medio</td>
              <td>No disponible</td>
              <td>
                <a href="#" class="icon-btn" title="Eliminar">🗑️</a>
              </td>
            </tr>
            <tr>
              <td>EJ003</td>
              <td>Depósito, revisión técnica</td>
              <td>Canje</td>
              <td>Biblioteca UBA</td>
              <td>Indeterminado</td>
              <td>No disponible</td>
              <td>
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