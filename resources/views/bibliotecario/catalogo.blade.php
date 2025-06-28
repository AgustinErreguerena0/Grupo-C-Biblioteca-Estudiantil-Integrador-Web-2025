<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Biblioteca - Catálogo</title>
    <link rel="stylesheet" href="../style.css" />
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
        <div class="d-flex justify-content-between mb-3">
          <h1 class="section-title">Catálogo</h1>
          <a href="alta-catalogo.html" class="btn btn-primary"
            >Nuevo catálogo</a
          >
        </div>

        <div class="card">
          <!-- Nuevo contenedor .search-bar -->
          <div class="search-bar">
            <input
              type="text"
              class="form-control"
              placeholder="Buscar por title o creator"
            />

            <button class="btn btn-primary">Buscar</button>
          </div>
        </div>
        <div class="card">
          <table class="table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Creador</th>
                <th>Asunto</th>
                <th>Descripción</th>
                <th>Editor</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Identificador</th>
                <th>Idioma</th>
                <th>Formato</th>
                <th>Derechos</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Historia de la Computación</td>
                <td>Juan Pérez</td>
                <td>Computación, Historia</td>
                <td>
                  Un documento que narra los hitos principales de la
                  computación.
                </td>
                <td>Universidad X</td>
                <td>2025-06-22</td>
                <td>Texto</td>
                <td>ISBN 978-3-16-148410-0</td>
                <td>es</td>
                <td>PDF</td>
                <td>CC BY-NC-SA 4.0</td>
                <td>
                  <a href="detalle-catalogo.html" class="icon-btn" title="Ver"
                    >👁️</a
                  >
                  <a href="#" class="icon-btn" title="Modificar">✏️</a>
                  <a href="#" class="icon-btn" title="Eliminar">🗑️</a>
                  <a href="ejemplares.html" class="icon-btn" title="Ejemplares"
                    >📚</a
                  >
                </td>
              </tr>
              <tr>
                <td>Introducción a la Filosofía</td>
                <td>Laura Méndez</td>
                <td>Filosofía, Pensamiento Crítico</td>
                <td>
                  Este libro presenta los principales conceptos y corrientes
                  filosóficos desde la Antigüedad hasta el siglo XX. Ideal para
                  estudiantes de nivel
                </td>
                <td>Editorial Alfachnega</td>
                <td>2018-03-12</td>
                <td>Texto impreso</td>
                <td>ISBN 978-950-556-938-5</td>
                <td>es</td>
                <td>400 páginas, tapa blanda, 23 cm x 15 cm</td>
                <td>
                  © 2019 Laura Méndez. Prohibida su reproducción sin
                  autorización
                </td>
                <td>
                  <a href="detalle-catalogo.html" class="icon-btn" title="Ver"
                    >👁️</a
                  >
                  <a href="#" class="icon-btn" title="Modificar">✏️</a>
                  <a href="#" class="icon-btn" title="Eliminar">🗑️</a>
                  <a href="ejemplares.html" class="icon-btn" title="Ejemplares"
                    >📚</a
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>
