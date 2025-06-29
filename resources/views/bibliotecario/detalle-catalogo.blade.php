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
        <a href="{{ url('bibliotecario/inicio') }}" class="sidebar-link">Inicio</a>
      </li>
      <li class="sidebar-item">
        <a href="{{ url('bibliotecario/miembros') }}" class="sidebar-link">Miembros</a>
      </li>
      <li class="sidebar-item">
        <a href="{{ url('bibliotecario/circulacion') }}" class="sidebar-link">Circulación</a>
      </li>
      <li class="sidebar-item">
        <a href="{{ url('bibliotecario/catalogo') }}" class="sidebar-link active">Catálogo</a> {{-- Añadido 'active' para indicar la página actual --}}
      </li>
    </ul>
  </aside>
    
    <main class="main">
      <nav class="breadcrumb">
        <a href="{{ url('bibliotecario/catalogo') }}">Catálogo</a> &raquo; Detalle
      </nav>
      
      <div class="d-flex justify-content-between mb-3">
        <h1 class="section-title">Detalle de Catálogo</h1>
        <a href="{{ url('bibliotecario/catalogo') }}" class="btn">Volver</a> {{-- Enlace correcto a la vista principal del catálogo --}}
      </div>
      
      <div class="card">
        <div class="detail-grid">
          <div class="detail-label">Title:</div>
          <div class="detail-value">{{ $catalogoItem->title }}</div> {{-- Muestra el título dinámicamente --}}
          
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
          <div class="detail-value">{{ $catalogoItem->description }}</div> {{-- Muestra la descripción dinámicamente --}}
          
          <div class="detail-label">Publisher:</div>
          <div class="detail-value">{{ $catalogoItem->publisher->publisher ?? 'N/A' }}</div> {{-- Muestra la editorial dinámicamente, con 'N/A' si no existe --}}
          
          <div class="detail-label">Date:</div>
          <div class="detail-value">{{ $catalogoItem->date }}</div> {{-- Muestra la fecha dinámicamente --}}
          
          <div class="detail-label">Type:</div>
          <div class="detail-value">{{ $catalogoItem->type }}</div> {{-- Muestra el tipo dinámicamente --}}
          
          <div class="detail-label">Identifier:</div>
          <div class="detail-value">{{ $catalogoItem->identifier }}</div> {{-- Muestra el identificador dinámicamente --}}
          
          <div class="detail-label">Language:</div>
          <div class="detail-value">{{ $catalogoItem->language }}</div> {{-- Muestra el idioma dinámicamente --}}
          
          <div class="detail-label">Format:</div>
          <div class="detail-value">{{ $catalogoItem->format }}</div> {{-- Muestra el formato dinámicamente --}}
          
          <div class="detail-label">Rights:</div>
          <div class="detail-value">{{ $catalogoItem->rights }}</div> {{-- Muestra los derechos dinámicamente --}}
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
            {{-- Itera sobre los ejemplares asociados al ítem de catálogo --}}
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