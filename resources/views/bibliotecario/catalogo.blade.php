<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca - Catálogo</title>
<link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
  <header class="header">
    <div class="container header-content">
      <div class="logo">Biblioteca Estudiantil</div>
      <nav class="nav">
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn-cerrar-sesion" >
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
          <a href="{{ url('bibliotecario/catalogo') }}" class="sidebar-link">Catálogo</a>
        </li>
      </ul>
    </aside>

    <main class="main">
      <main class="main">
        <div class="d-flex justify-content-between mb-3">
          <h1 class="section-title">Catálogo</h1>
          <a href="{{ url('bibliotecario/alta-catalogo') }}" class="btn btn-primary">Nuevo catálogo</a>
        </div>
        <div class="card">
          {{-- El formulario ahora es el contenedor flex --}}
          <form action="{{ url('bibliotecario/catalogo') }}" method="GET" class="search-form">
            <input
              type="text"
              class="form-control"
              placeholder="Buscar por title, creator, subject o publisher" 
              name="search_query"
              value="{{ request('search_query') }}"  />
            <button type="submit" class="btn btn-primary">Buscar</button>
          </form>
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
              @forelse($catalogItems as $item)
              <tr>
                <td>{{ $item->title }}</td>
                {{-- Mostrar los nombres de los creadores separados por coma --}}
                <td>
                  @foreach($item->creators as $creator)
                  {{ $creator->creator }}{{ !$loop->last ? ', ' : '' }}
                  @endforeach
                </td>
                {{-- Mostrar los nombres de los temas separados por coma --}}
                <td>
                  @foreach($item->subjects as $subject)
                  {{ $subject->subject }}{{ !$loop->last ? ', ' : '' }}
                  @endforeach
                </td>
                <td>{{ $item->description }}</td>

                <td>{{ $item->publisher->publisher ?? 'N/A' }}</td> 
                <td>{{ $item->date }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->identifier }}</td>
                <td>{{ $item->language }}</td> 
                <td>{{ $item->format }}</td>
                <td>{{ $item->rights }}</td>
                <td>
                  <a href="{{ url('bibliotecario/catalogo/detalle/' . $item->id_catalogo) }}" class="icon-btn" title="Ver">👁️</a>
                  <a href="{{ url('bibliotecario/catalogo/modificar/' . $item->id_catalogo) }}" class="icon-btn" title="Modificar">✏️</a>
                
                  <form action="{{ url('bibliotecario/catalogo/eliminar/' . $item->id_catalogo) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE') 
                    <button type="submit" class="icon-btn" title="Eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar este catálogo?')">🗑️</button>
                  </form>
                  <a href="{{ url('bibliotecario/catalogo/ejemplares/' . $item->id_catalogo) }}" class="icon-btn" title="Ejemplares">📚</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="12">
                  @if(request('search_query'))
                  No se encontraron resultados para "{{ request('search_query') }}".
                  @else
                  No hay elementos en el catálogo.
                  @endif
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </main>
  </div>
</body>

</html>