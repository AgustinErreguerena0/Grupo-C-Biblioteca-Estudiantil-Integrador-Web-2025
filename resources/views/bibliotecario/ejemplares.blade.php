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
          <a href="{{ url('bibliotecario/catalogo') }}" class="sidebar-link active">Catálogo</a>
        </li>
      </ul>
    </aside>

    <main class="main">
      <nav class="breadcrumb">
        <a href="{{ url('bibliotecario/catalogo') }}">Catálogo</a> &raquo; Gestión de Ejemplares
      </nav>

      <div class="d-flex justify-content-between mb-3">
        <h1 class="section-title">Gestión de Ejemplares</h1>
           <a href="{{ url('bibliotecario/catalogo') }}" class="btn">Volver</a> 
      </div>

      <div class="card">
        <div class="detail-grid">
          <div class="detail-label">Title:</div>
          <div class="detail-value">{{ $catalogoItem->title }}</div>           
          <div class="detail-label">Creator:</div>
          <div class="detail-value">
            {{-- Itera y muestra los nombres de los creadores separados por coma --}}
            @foreach($catalogoItem->creators as $creator)
              {{ $creator->creator }}{{ !$loop->last ? ', ' : '' }}
            @endforeach
          </div>
          
          <div class="detail-label">Subject:</div>
          <div class="detail-value">
            {{-- Itera y muestra los nombres de los temas separados por coma --}}
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
      <div class="card">
        <h3>Nuevo Ejemplar</h3>
        <form>
          <div class="form-group">
            <label for="id_publico" class="form-label">Identificador*</label>
            <input type="text" id="id_publico" name="id_publico" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control">
          </div>

          <div class="form-group">
            <label for="procedencia" class="form-label">Procedencia</label>
            <input type="text" id="procedencia" name="procedencia" class="form-control">
          </div>

          {{-- Campo para seleccionar Proveedor --}}
          <div class="form-group">
              <label for="id_proveedor" class="form-label">Proveedor</label>
              <select id="id_proveedor" class="form-control" name="id_proveedor">
                  <option value="">Seleccione un proveedor</option>
                  {{-- Asegúrate de que $proveedores se pasa desde el controlador --}}
                  @foreach($proveedores as $proveedor)
                      <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->proveedor }}</option>
                  @endforeach
              </select>
          </div>

          <div class="form-group">
            <label for="estado_material" class="form-label">Estado del ejemplar</label>
            <select id="estado_material" name="estado_material" class="form-control">
              <option value="Bueno">En correcto estado</option>
              <option value="Daño leve">Daño leve</option>
              <option value="Daño medio">Daño medio</option>
              <option value="Indeterminado">Indeterminado</option>
            </select>
          </div>

          <div class="form-group">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <select id="disponibilidad" name="disponibilidad" class="form-control">
              <option value="Disponible">Disponible</option>
              <option value="No disponible">No disponible</option>
            </select>
          </div>
          {{-- Campo oculto para asociar el ejemplar al ID del catálogo --}}
          <input type="hidden" name="id_catalogo" value="{{ $catalogoItem->id_catalogo }}">

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>

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
            {{-- Itera sobre los ejemplares asociados al ítem de catálogo --}}
            @forelse($catalogoItem->ejemplares as $ejemplar)
            <tr>
              <td>{{ $ejemplar->id_publico }}</td>
              <td>{{ $ejemplar->ubicacion }}</td>
              <td>{{ $ejemplar->procedencia }}</td>
              <td>{{ $ejemplar->proveedor->proveedor ?? 'N/A' }}</td> {{-- Acceder al nombre del proveedor --}}
              <td>{{ $ejemplar->estado_material }}</td>
              <td>{{ $ejemplar->disponibilidad }}</td>
              <td>
                <a href="#" class="icon-btn" title="Eliminar">🗑️</a>
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
</body>

</html>