<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Gestión de Miembros</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}"> {{-- ¡Importante usar asset()! --}}
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
        <a href="{{ url('bibliotecario/miembros') }}" class="sidebar-link active">Miembros</a> {{-- Añadido 'active' --}}
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
        <h1 class="section-title">Gestión de Miembros</h1>
        <a href="{{ url('bibliotecario/alta-miembro') }}" class="btn btn-primary">Nuevo Miembro</a>
      </div>
      
      {{-- Formulario de Búsqueda --}}
      <div class="card mb-3">
        <form action="{{ route('bibliotecario.miembros') }}" method="GET" class="search-form">
          <input
            type="text"
            class="form-control"
            placeholder="Buscar miembro por nombre, apellido, DNI, correo, télefono, dirección, tipo miembro o usuario"
            name="search_query"
            value="{{ request('search_query') }}" {{-- Mantiene el valor de búsqueda en el input --}}
          />
          <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
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
              <th>Tipo Miembro</th>
              <th>Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {{-- Itera sobre los miembros pasados desde el controlador --}}
            @forelse($miembros as $miembro)
              <tr>
                <td>{{ $miembro->nombre }}</td>
                <td>{{ $miembro->apellido }}</td>
                <td>{{ $miembro->dni }}</td>
                <td>{{ $miembro->correo }}</td>
                <td>{{ $miembro->telefono }}</td>
                <td>{{ $miembro->direccion }}</td>
                <td>{{ $miembro->tipo_miembro }}</td>
                <td>{{ $miembro->usuario }}</td>
                <td>
                  <a href="{{ url('bibliotecario/miembros/detalle/' . $miembro->id_miembro) }}" class="icon-btn" title="Ver">👁️</a>
                  {{-- Faltaría implementar rutas para modificar y eliminar miembros --}}
                  <a href="{{ url('bibliotecario/miembros/modificar/' . $miembro->id_miembro) }}" class="icon-btn" title="Modificar">✏️</a>
                  <form action="{{ url('bibliotecario/miembros/eliminar/' . $miembro->id_miembro) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="icon-btn" title="Eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar este miembro?');">🗑️</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center">No se encontraron miembros.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>