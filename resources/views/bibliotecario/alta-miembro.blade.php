<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nuevo Miembro</title>
    <link rel="stylesheet" href="../style.css" />
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
        <a href="{{ url('bibliotecario/catalogo') }}" class="sidebar-link">Catálogo</a>
      </li>
    </ul>
  </aside>

      <main class="main">
        <h1 class="section-title">Nuevo Miembro</h1>

        {{-- Mensajes de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
          <form action="{{ route('bibliotecario.miembro.alta') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="nombre" class="form-label">Nombre *</label>
              <input
                type="text"
                id="nombre"
                name="nombre"
                class="form-control"
                required
                value="{{ old('nombre') }}" {{-- Para mantener el valor si hay error --}}
              />
            </div>

            <div class="form-group">
              <label for="apellido" class="form-label">Apellido *</label>
              <input
                type="text"
                id="apellido"
                name="apellido"
                class="form-control"
                required
                value="{{ old('apellido') }}"
              />
            </div>

            <div class="form-group">
              <label for="dni" class="form-label">DNI *</label>
              <input
                type="text"
                id="dni"
                name="dni"
                class="form-control"
                required
                value="{{ old('dni') }}"
              />
            </div>

            <div class="form-group">
              <label for="correo" class="form-label"
                >Correo electrónico *</label
              >
              <input
                type="email"
                id="correo"
                name="correo"
                class="form-control"
                required
                value="{{ old('correo') }}"
              />
            </div>

            <div class="form-group">
              <label for="telefono" class="form-label">Teléfono *</label>
              <input
                type="tel"
                id="telefono"
                name="telefono"
                class="form-control"
                required
                value="{{ old('telefono') }}"
              />
            </div>

            <div class="form-group">
              <label for="direccion" class="form-label">Dirección *</label>
              <input
                type="text"
                id="direccion"
                name="direccion"
                class="form-control"
                required
                value="{{ old('direccion') }}"
              />
            </div>

            <div class="form-group">
              <label for="tipo" class="form-label">Tipo de miembro *</label>
              <select id="tipo" name="tipo_miembro" class="form-control" required>
                <option value="">Seleccionar...</option>
                <option value="Estudiante" {{ old('tipo_miembro') == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
                <option value="Profesor" {{ old('tipo_miembro') == 'Profesor' ? 'selected' : '' }}>Profesor</option>
                <option value="Investigador" {{ old('tipo_miembro') == 'Investigador' ? 'selected' : '' }}>Investigador</option>
              </select>
            </div>

            <div class="form-group">
              <label for="usuario" class="form-label">Usuario *</label>
              <input
                type="text"
                id="usuario"
                name="usuario"
                class="form-control"
                required
                value="{{ old('usuario') }}"
              />
            </div>

            <div class="form-group text-center mt-3">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <a href="{{ url('bibliotecario/miembros') }}" class="btn btn-primary">Cancelar</a>
            </div>
          </form>
        </div>
      </main>
    </div>
  </body>
</html>