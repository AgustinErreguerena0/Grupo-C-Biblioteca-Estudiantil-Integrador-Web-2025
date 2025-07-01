<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Devolución</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .alert-success {
      background-color: rgba(53, 220, 70, 0.1);
      border: 1px solid rgba(53, 220, 70, 0.2);
      color: #28a745; /* Verde fuerte */
      font-weight: 600;
    }
  </style>
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
        <li class="sidebar-item"><a href="{{ url('bibliotecario/inicio') }}" class="sidebar-link">Inicio</a></li>
        <li class="sidebar-item"><a href="{{ url('bibliotecario/miembros') }}" class="sidebar-link">Miembros</a></li>
        <li class="sidebar-item"><a href="{{ url('bibliotecario/circulacion') }}" class="sidebar-link">Circulación</a></li>
        <li class="sidebar-item"><a href="{{ url('bibliotecario/catalogo') }}" class="sidebar-link">Catálogo</a></li>
      </ul>
    </aside>

    <main class="main">
      <h1 class="section-title">Devolución</h1>

      {{-- Mensajes de éxito y error --}}
      <div id="alert-exito" class="alert alert-success" style="display: none;"></div>
      <div id="alert-error" class="alert alert-danger" style="display: none;"></div>

      <div class="card">
        <h2>Préstamo</h2>
        <div class="form-group">
          <label for="id-prestamo" class="form-label">Identificador del préstamo</label>
          <input type="text" id="id-prestamo" class="form-control">
        </div>
        <button id="btn-devolver" class="btn btn-primary">Efectuar Devolución</button>
      </div>
    </main>
  </div>

  {{-- ===================== SCRIPTS ===================== --}}
  <script>
    const $ = id => document.getElementById(id);

    function mostrarAlerta(id, mensaje) {
      ['alert-exito', 'alert-error'].forEach(x => $(x).style.display = 'none');
      if (mensaje) {
        $(id).innerText = mensaje;
        $(id).style.display = 'block';
      }
    }

    $('btn-devolver').addEventListener('click', () => {
      const idPrestamo = $('id-prestamo').value.trim();

      if (!idPrestamo) {
        mostrarAlerta('alert-error', 'Debe ingresar un ID de préstamo válido.');
        return;
      }

      // Validar que sea un número entero
      if (!/^\d+$/.test(idPrestamo)) {
        mostrarAlerta('alert-error', 'El ID debe ser un número entero válido.');
        return;
      }

      fetch("{{ route('prestamo.devolver') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id_prestamo: idPrestamo })
      })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          mostrarAlerta('alert-error', data.error);
        } else {
          mostrarAlerta('alert-exito', data.message);
          $('id-prestamo').value = '';
          setTimeout(() => window.location.reload(), 2500);
        }
      })
      .catch(() => {
        mostrarAlerta('alert-error', 'Ocurrió un error inesperado.');
      });
    });
  </script>
</body>
</html>
