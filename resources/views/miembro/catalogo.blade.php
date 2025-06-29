<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca - Miembro | Catálogo</title> {{-- Título más descriptivo --}}
  <link rel="stylesheet" href="{{ asset('style.css') }}" /> {{-- ¡Importante usar asset()! --}}
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
          <a href="{{ route('miembro.catalogo') }}" class="sidebar-link active">Catálogo</a> {{-- ¡CAMBIO AQUÍ! --}}
        </li>
        {{-- Puedes añadir más enlaces aquí para el miembro si los necesitas --}}
        {{-- <li class="sidebar-item">
            <a href="{{ url('miembro/prestamos') }}" class="sidebar-link">Mis Préstamos</a>
        </li> --}}
      </ul>
    </aside>

    <main class="main"> {{-- Corregida la duplicidad de la etiqueta main --}}
      <h1 class="section-title">Catálogo</h1>

      <div class="card mb-3"> {{-- Añadido mb-3 para espacio inferior --}}
        {{-- El formulario de búsqueda --}}
        <form action="{{ route('miembro.catalogo') }}" method="GET" class="search-form"> {{-- ¡CAMBIO AQUÍ! --}}
          <input
            type="text"
            class="form-control"
            placeholder="Buscar por title, creator, subject o publisher"
            name="search_query"
            value="{{ request('search_query') }}" {{-- Mantiene el término de búsqueda --}} />
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
            {{-- Itera sobre los ítems de catálogo pasados desde el controlador --}}
            @forelse($catalogItems as $item) {{-- Cambiado $item a $catalogItems según el controlador --}}
            <tr>
              <td>{{ $item->title }}</td>
              <td>
                {{-- Muestra los nombres de los creadores separados por coma --}}
                @foreach($item->creators as $creator)
                {{ $creator->creator }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
              </td>
              <td>
                {{-- Muestra los nombres de los temas separados por coma --}}
                @foreach($item->subjects as $subject)
                {{ $subject->subject }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
              </td>
              <td>{{ $item->description }}</td>
              {{-- Acceder al nombre de la editorial a través de la relación --}}
              <td>{{ $item->publisher->publisher ?? 'N/A' }}</td> {{-- Usamos ?? 'N/A' por si no hay publisher asociado --}}
              <td>{{ $item->date }}</td>
              <td>{{ $item->type }}</td>
              <td>{{ $item->identifier }}</td>
              <td>{{ $item->language }}</td>
              <td>{{ $item->format }}</td>
              <td>{{ $item->rights }}</td>
              <td>
                {{-- Enlace a la vista de detalle del catálogo para el miembro --}}
                <a href="{{ route('miembro.catalogo.detalle', $item->id_catalogo) }}" class="icon-btn" title="Ver">👁️</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="12" class="text-center">
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