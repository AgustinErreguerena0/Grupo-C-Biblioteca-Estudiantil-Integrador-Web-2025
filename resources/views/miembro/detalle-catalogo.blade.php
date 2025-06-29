<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Detalle de Catálogo</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
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
          <a href="{{ route('miembro.catalogo') }}" class="sidebar-link active">Catálogo</a> 
        </li>
        
      </ul>
    </aside>


    <main class="main">
      <nav class="breadcrumb">
        <a href="{{ route('miembro.catalogo') }}">Catálogo</a> &raquo; Detalle 
      </nav>

      <div class="d-flex justify-content-between mb-3">
        <h1 class="section-title">Detalle de Catálogo</h1>
        <a href="{{ url('miembro/catalogo') }}" class="btn">Volver</a> 
      </div>

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

      <h2 class="section-subtitle mt-4">Ejemplares asociados</h2>

      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Identificador</th>
              <th>Ubicación</th>
              <th>Procedencia</th>
              <th>Estado</th>
              <th>Disponibilidad</th>
            </tr>
          </thead>
          <tbody>
            
            @forelse($catalogoItem->ejemplares as $ejemplar)
            <tr>
              <td>{{ $ejemplar->id_ejemplar }}</td> {{-- ID del ejemplar --}}
              <td>{{ $ejemplar->ubicacion }}</td> {{-- Ubicación del ejemplar --}}
              <td>{{ $ejemplar->procedencia }}</td> {{-- Procedencia del ejemplar --}}
              <td>{{ $ejemplar->estado_material }}</td> {{-- Estado del material del ejemplar --}}
              <td><span class="badge {{ $ejemplar->disponibilidad == 'Disponible' ? 'available' : 'unavailable' }}">{{ $ejemplar->disponibilidad }}</span></td> {{-- Disponibilidad con badge --}}
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center">No hay ejemplares asociados a este ítem de catálogo.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>

</html>