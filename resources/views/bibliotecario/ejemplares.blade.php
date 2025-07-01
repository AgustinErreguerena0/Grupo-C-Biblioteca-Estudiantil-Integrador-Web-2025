<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Gestión de Ejemplares</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
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
        <li class="sidebar-item"><a href="{{ url('bibliotecario/catalogo') }}" class="sidebar-link active">Catálogo</a></li>
      </ul>
    </aside>

    <main class="main">
      <nav class="breadcrumb">
        <a href="{{ url('bibliotecario/catalogo') }}">Catálogo</a> &raquo; Gestión de Ejemplares
      </nav>

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <div class="d-flex justify-content-between mb-3">
        <h1 class="section-title">Gestión de Ejemplares</h1>
        <a href="{{ url('bibliotecario/catalogo') }}" class="btn">Volver</a>
      </div>

      {{-- === Detalle del catálogo === --}}
      <div class="card">
        <div class="detail-grid">
          <div class="detail-label">Title:</div>
          <div class="detail-value">{{ $catalogoItem->title }}</div>

          <div class="detail-label">Creator:</div>
          <div class="detail-value">
            @foreach($catalogoItem->creators as $creator)
              {{ $creator->creator }}{{ !$loop->last ? ', ' : '' }}
            @endforeach
          </div>

          <div class="detail-label">Subject:</div>
          <div class="detail-value">
            @foreach($catalogoItem->subjects as $subject)
              {{ $subject->subject }}{{ !$loop->last ? ', ' : '' }}
            @endforeach
          </div>

          <div class="detail-label">Description:</div>
          <div class="detail-value">{{ $catalogoItem->description }}</div>

          <div class="detail-label">Publisher:</div>
          <div class="detail-value">{{ $catalogoItem->publisher->publisher ?? 'N/A' }}</div>

          <div class="detail-label">Date:</div>
          <div class="detail-value">{{ $catalogoItem->date }}</div>

          <div class="detail-label">Type:</div>
          <div class="detail-value">{{ $catalogoItem->type }}</div>

          <div class="detail-label">Identifier:</div>
          <div class="detail-value">{{ $catalogoItem->identifier }}</div>

          <div class="detail-label">Language:</div>
          <div class="detail-value">{{ $catalogoItem->language }}</div>

          <div class="detail-label">Format:</div>
          <div class="detail-value">{{ $catalogoItem->format }}</div>

          <div class="detail-label">Rights:</div>
          <div class="detail-value">{{ $catalogoItem->rights }}</div>
        </div>
      </div>

      {{-- === Formulario de nuevo ejemplar === --}}
      <div class="card">
        <h3>Nuevo Ejemplar</h3>
        <form id="nuevoEjemplarForm" action="{{ route('bibliotecario.ejemplar.store', $catalogoItem->id_catalogo) }}" method="POST">
          @csrf

          <div class="form-group">
            <label for="id_publico" class="form-label">Identificador*</label>
            <input type="text" id="id_publico" name="id_publico" class="form-control" value="{{ old('id_publico') }}" required>
            @error('id_publico')<div class="error">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="ubicacion" class="form-label">Ubicación*</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}" required>
            @error('ubicacion')<div class="error">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="procedencia" class="form-label">Procedencia*</label>
            <select id="procedencia" name="procedencia" class="form-control" required>
              <option value="Compra"   {{ old('procedencia', 'Compra') == 'Compra' ? 'selected' : '' }}>Compra</option>
              <option value="Canje"    {{ old('procedencia') == 'Canje' ? 'selected' : '' }}>Canje</option>
              <option value="Donación" {{ old('procedencia') == 'Donación' ? 'selected' : '' }}>Donación</option>
            </select>
            @error('procedencia')<div class="error">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="id_proveedor" class="form-label d-flex justify-content-between align-items-center">
              <span>Proveedor</span>
              <a href="{{ url('bibliotecario/proveedores') }}" class="btn btn-sm btn-secondary">...</a>
            </label>
            <select id="id_proveedor" name="id_proveedor" class="form-control">
              <option value="">-- Sin selección --</option>
              @foreach($proveedores as $prov)
                <option value="{{ $prov->id_proveedor }}" {{ old('id_proveedor') == $prov->id_proveedor ? 'selected' : '' }}>
                  {{ $prov->proveedor }}
                </option>
              @endforeach
            </select>
            @error('id_proveedor')<div class="error">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="estado_material" class="form-label">Estado del ejemplar*</label>
            <select id="estado_material" name="estado_material" class="form-control" required>
              <option value="Bueno"      {{ old('estado_material')=='Bueno'?'selected':'' }}>En correcto estado</option>
              <option value="Daño leve"  {{ old('estado_material')=='Daño leve'?'selected':'' }}>Daño leve</option>
              <option value="Daño medio" {{ old('estado_material')=='Daño medio'?'selected':'' }}>Daño medio</option>
              <option value="Indeterminado" selected>Indeterminado</option>
            </select>
            @error('estado_material')<div class="error">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="disponibilidad" class="form-label">Disponibilidad*</label>
            <select id="disponibilidad" name="disponibilidad" class="form-control" required>
              <option value="Disponible"    selected>Disponible</option>
              <option value="No disponible" {{ old('disponibilidad')=='No disponible'?'selected':'' }}>No disponible</option>
            </select>
            @error('disponibilidad')<div class="error">{{ $message }}</div>@enderror
          </div>

          <input type="hidden" name="id_catalogo" value="{{ $catalogoItem->id_catalogo }}">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>

      {{-- === Tabla de ejemplares existentes === --}}
      <div class="card">
        <h3>Ejemplares asociados</h3>
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
            @forelse($catalogoItem->ejemplares as $ejemplar)
              <tr>
                <td>{{ $ejemplar->id_publico }}</td>
                <td>{{ $ejemplar->ubicacion }}</td>
                <td>{{ $ejemplar->procedencia }}</td>
                <td>{{ $ejemplar->proveedor->proveedor ?? 'N/A' }}</td>
                <td>{{ $ejemplar->estado_material }}</td>
                <td>{{ $ejemplar->disponibilidad }}</td>
                <td>
                  <form action="#" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-btn" onclick="return confirm('¿Eliminar ejemplar?')" title="Eliminar">🗑️</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">No hay ejemplares asociados a este ítem de catálogo.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <script>
    // Validación para que no quede "Indeterminado"
    document.getElementById('nuevoEjemplarForm').addEventListener('submit', function(e) {
      if (document.getElementById('estado_material').value === 'Indeterminado') {
        e.preventDefault();
        alert('Por favor, seleccione un estado de material distinto a "Indeterminado".');
      }
    });

    // Si el controlador devolvió session('success'), reseteamos el formulario al cargar
    @if(session('success'))
      window.addEventListener('DOMContentLoaded', function() {
        document.getElementById('nuevoEjemplarForm').reset();
      });
    @endif
  </script>
</body>
</html>
