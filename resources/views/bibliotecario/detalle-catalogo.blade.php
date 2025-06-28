<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Detalle de Catálogo</title>
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
      <nav class="breadcrumb">
        <a href="catalogo.html">Catálogo</a> &raquo; Detalle
      </nav>
      
      <div class="d-flex justify-content-between mb-3">
        <h1 class="section-title">Detalle de Catálogo</h1>
        <a href="catalogo.html" class="btn">Volver</a>
      </div>
      
      <div class="card">
        <div class="detail-grid">
          <div class="detail-label">Title:</div>
          <div class="detail-value">Historia de la Computación</div>
          
          <div class="detail-label">Creator:</div>
          <div class="detail-value">Juan Pérez</div>
          
          <div class="detail-label">Subject:</div>
          <div class="detail-value">Computación, Historia</div>
          
          <div class="detail-label">Description:</div>
          <div class="detail-value">Un documento que narra los hitos principales de la computación desde sus inicios hasta la actualidad, incluyendo los principales avances tecnológicos y sus protagonistas.</div>
          
          <div class="detail-label">Publisher:</div>
          <div class="detail-value">Universidad X</div>
          
          <div class="detail-label">Date:</div>
          <div class="detail-value">2025-06-22</div>
          
          <div class="detail-label">Type:</div>
          <div class="detail-value">Texto</div>
          
          <div class="detail-label">Identifier:</div>
          <div class="detail-value">ISBN 978-3-16-148410-0</div>
          
          <div class="detail-label">Language:</div>
          <div class="detail-value">Español (es)</div>
          
          <div class="detail-label">Format:</div>
          <div class="detail-value">PDF</div>
          
          <div class="detail-label">Rights:</div>
          <div class="detail-value">CC BY-NC-SA 4.0</div>
        </div>
      </div>
      
      <h2 class="section-subtitle mt-4">Ejemplares asociados</h2>
      
      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Identificador</th>
              <th>Ubicación</th>
              <th>Procedencia</th>
              <th>Estado</th>
              <th>Disponibilidad</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>EJ001</td>
              <td>Estante A2, Sección Filosofía</td>
              <td>Compra</td>
              <td>En correcto estado</td>
              <td><span class="badge available">Disponible</span></td>
            </tr>
            <tr>
              <td>EJ002</td>
              <td>Estante B1, Sección Historia</td>
              <td>Donación</td>
              <td>Daño medio</td>
              <td><span class="badge unavailable">No disponible</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>