<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca - Préstamo</title>
  <link rel="stylesheet" href="../style.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .alert.alert-info {
      background-color: rgba(53, 220, 70, 0.1);  /* fondo verde claro suave */
      border: 1px solid rgba(53, 220, 70, 0.2);   /* borde verde claro */
      color: #343a40;                            /* gris oscuro */
      font-weight: 600;
    }
    .alert.alert-success {
      background-color: rgba(53, 220, 70, 0.2);  /* fondo más visible */
      border: 1px solid rgba(53, 220, 70, 0.3);
      color: #2e7d32;                           /* verde fuerte */
      font-weight: 600;
    }
    .alert.alert-danger {
      background-color: rgba(220, 53, 69, 0.1);
      border: 1px solid rgba(220, 53, 69, 0.2);
      color: #343a40; /* gris oscuro */
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
      <h1 class="section-title">Nuevo Préstamo</h1>

      {{-- ZONA NARANJA: Alerta de miembro --}}
      <div id="alert-miembro" style="display: none;" class="alert"></div>

      {{-- Formulario Miembro --}}
      <div class="card">
        <h2>Miembro</h2>
        <div class="form-group">
          <label for="dni-miembro" class="form-label">Ingrese el DNI del miembro</label>
          <input type="text" id="dni-miembro" class="form-control" />
        </div>
      </div>

      {{-- ZONA AZUL: Alerta de ejemplar --}}
      <div id="alert-ejemplar" style="display: none;" class="alert"></div>

      {{-- Formulario Ejemplar --}}
      <div class="card">
        <h2>Ejemplar</h2>
        <div class="form-group">
          <label for="id-ejemplar" class="form-label">Ingrese el identificador del ejemplar</label>
          <input type="text" id="id-ejemplar" class="form-control" />
        </div>
        <button type="button" id="btn-agregar" class="btn btn-primary">Agregar</button>
      </div>

      {{-- ZONA VERDE: Mensajes relacionados al botón Agregar y Efectuar Préstamo --}}
      <div id="alert-exito" class="alert alert-success" style="display: none;"></div>
      <div id="alert-error" class="alert alert-danger" style="display: none;"></div>

      {{-- Tabla de ejemplares --}}
      <div class="card">
        <h2>Ejemplares Seleccionados</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Identificador</th>
              <th>Ubicación</th>
              <th>Título</th>
              <th>Creador</th>
              <th>Asunto</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody id="tabla-ejemplares"></tbody>
        </table>
      </div>

      <div class="text-center mt-3">
        <button type="button" id="btn-prestar" class="btn btn-primary">Efectuar Préstamo</button>
        <a href="{{ url('bibliotecario/circulacion') }}" class="btn btn-primary">Cancelar</a>
      </div>
    </main>
  </div>

  {{-- ====================== SCRIPTS ====================== --}}
  <script>
    let ejemplaresAgregados = [];

    const $ = (id) => document.getElementById(id);

    function mostrarAlerta(id, mensaje) {
      const el = $(id);
      el.style.display = 'none';
      el.classList.remove('alert-success', 'alert-danger', 'alert-info');

      if (mensaje) {
        el.innerText = mensaje;

        const lower = mensaje.toLowerCase();
        if (
          lower.includes('no encontrado') ||
          lower.includes('no disponible') ||
          lower.includes('error') ||
          lower.includes('ya fue agregado') ||
          lower.includes('debe ingresar')
        ) {
          el.classList.add('alert-danger');
        } else if (lower.includes('miembro:') || lower.includes('ejemplar disponible')) {
          el.classList.add('alert-info');
        } else {
          el.classList.add('alert-success');
        }

        el.style.display = 'block';
      }
    }

    $('dni-miembro').addEventListener('blur', () => {
      const dni = $('dni-miembro').value.trim();
      if (!dni) return;

      fetch("{{ route('prestamo.buscarMiembro') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ dni })
      })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          mostrarAlerta('alert-miembro', data.error);
        } else {
          mostrarAlerta('alert-miembro', `Miembro: ${data.nombre} ${data.apellido}`);
        }
      });
    });

    $('id-ejemplar').addEventListener('blur', () => {
      const id_publico = $('id-ejemplar').value.trim();
      if (!id_publico) return;

      fetch("{{ route('prestamo.buscarEjemplar') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id_publico })
      })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          mostrarAlerta('alert-ejemplar', data.error);
        } else {
          mostrarAlerta('alert-ejemplar', 'Ejemplar disponible.');
        }
      });
    });

    $('btn-agregar').addEventListener('click', () => {
      const id_publico = $('id-ejemplar').value.trim();
      const dni = $('dni-miembro').value.trim();

      if (!id_publico || !dni) {
        mostrarAlerta('alert-error', 'Debe ingresar un DNI y al menos un ejemplar.');
        return;
      }

      fetch("{{ route('prestamo.buscarEjemplar') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id_publico })
      })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          mostrarAlerta('alert-error', data.error);
        } else {
          if (ejemplaresAgregados.includes(data.id_ejemplar)) {
            mostrarAlerta('alert-error', 'Este ejemplar ya fue agregado.');
            return;
          }

          ejemplaresAgregados.push(data.id_ejemplar);
          const fila = `
            <tr id="fila-${data.id_ejemplar}">
              <td>${data.id_publico}</td>
              <td>${data.ubicacion}</td>
              <td>${data.titulo}</td>
              <td>${data.creador}</td>
              <td>${data.asunto}</td>
              <td>
                <button class="btn btn-danger" onclick="eliminarEjemplar(${data.id_ejemplar})">🗑️</button>
              </td>
            </tr>
          `;
          document.getElementById('tabla-ejemplares').insertAdjacentHTML('beforeend', fila);
          mostrarAlerta('alert-error', '');
        }
      });
    });

    function eliminarEjemplar(id) {
      ejemplaresAgregados = ejemplaresAgregados.filter(e => e !== id);
      const fila = document.getElementById(`fila-${id}`);
      if (fila) fila.remove();
    }

    $('btn-prestar').addEventListener('click', () => {
      const dni = $('dni-miembro').value.trim();
      if (!dni || ejemplaresAgregados.length === 0) {
        mostrarAlerta('alert-error', 'Debe ingresar un DNI y al menos un ejemplar.');
        return;
      }

      fetch("{{ route('prestamo.guardar') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ dni: dni, ejemplares: ejemplaresAgregados })
      })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          mostrarAlerta('alert-error', data.error);
        } else {
          const fechaFormateada = new Date(data.fecha).toLocaleDateString('es-AR');
          $('alert-error').style.display = 'none';
          mostrarAlerta('alert-exito', `Préstamo exitoso. ID: ${data.id_prestamo} - Fecha: ${fechaFormateada}`);
          setTimeout(() => window.location.reload(), 3000);
        }
      });
    });
  </script>
</body>
</html>
