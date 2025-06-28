<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Biblioteca - Miembro</title>
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
            <a href="inicio.html" class="sidebar-link active">Catálogo</a>
          </li>
        </ul>
      </aside>

      <main class="main">
        <h1 class="section-title">Catálogo</h1>

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
                <th>Title</th>
                <th>Creator</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Publisher</th>
                <th>Date</th>
                <th>Type</th>
                <th>Identifier</th>
                <th>Language</th>
                <th>Format</th>
                <th>Rights</th>
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
                </td>
              </tr>
              <tr>
                <td>Introducción a la Filosofía</td>
                <td>Laura Méndez</td>
                <td>
                  Filosofía, Pensamiento Crítico, Historia de la Filosofía
                </td>
                <td>
                  Este libro presenta los principales conceptos y corrientes
                  filosóficas desde la antigüedad.
                </td>
                <td>Editorial AlfaOmega</td>
                <td>2018-03-12</td>
                <td>Texto impreso</td>
                <td>ISBN 978-950-556-938-5</td>
                <td>es</td>
                <td>400 páginas, tapa blanda, 23 cm x 15 cm</td>
                <td>
                  © 2018 Laura Méndez. Prohibida su reproducción sin
                  autorización del editor.
                </td>
                <td>
                  <a href="detalle-catalogo.html" class="icon-btn" title="Ver"
                    >👁️</a
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
