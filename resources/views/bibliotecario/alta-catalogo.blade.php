<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Alta de Catálogo</title>
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
      <div class="d-flex justify-content-between mb-3">
        <h1 class="section-title">Alta de Catálogo</h1>
        <a href="catalogo.html" class="btn">Volver</a>
      </div>
      
      <div class="card">
        <form>
          <div class="form-group">
            <label for="title" class="form-label">Título*</label>
            <input type="text" id="title" class="form-control" required>
          </div>
          
          <div class="form-group">
            <label for="creator" class="form-label">Creador*</label>
            <input type="text" id="creator" class="form-control" required>
          </div>
          
          <div class="form-group">
            <label for="subject" class="form-label">Asunto</label>
            <input type="text" id="subject" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="description" class="form-label">Descripción</label>
            <textarea id="description" class="form-control" rows="3"></textarea>
          </div>
          
          <div class="form-group">
            <label for="publisher" class="form-label">Editor</label>
            <input type="text" id="publisher" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" id="date" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="type" class="form-label">Tipo</label>
            <select id="type" class="form-control">
              <option value="texto">Texto</option>
              <option value="audio">Audio</option>
              <option value="video">Video</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="identifier" class="form-label">Identificador</label>
            <input type="text" id="identifier" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="language" class="form-label">Idioma</label>
            <input type="text" id="language" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="format" class="form-label">Formato</label>
            <input type="text" id="format" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="rights" class="form-label">Derechos</label>
            <input type="text" id="rights" class="form-control">
          </div>
          
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </main>
  </div>
</body>
</html>