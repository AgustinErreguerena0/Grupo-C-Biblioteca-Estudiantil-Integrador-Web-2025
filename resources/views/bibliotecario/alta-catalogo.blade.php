<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca - Alta de Catálogo</title>
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
        <li class="sidebar-item"><a href="{{ url('bibliotecario/catalogo') }}" class="sidebar-link">Catálogo</a></li>
      </ul>
    </aside>

    <main class="main">
      <div class="d-flex justify-content-between mb-3">
        <h1 class="section-title">Alta de Catálogo</h1>
        <a href="{{ route('bibliotecario.catalogo') }}" class="btn">Volver</a>
      </div>

      <div class="card">
        {{-- Mensaje de duplicado --}}
        @if($errors->has('duplicate'))
          <div class="error mb-3">
            {{ $errors->first('duplicate') }}
          </div>
        @endif

        <form action="{{ route('bibliotecario.catalogo.store') }}" method="POST">
          @csrf

          <div class="form-group">
            <label for="title" class="form-label">Title*</label>
            <input name="title" type="text" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="type" class="form-label">Type*</label>
            <select name="type" id="type" class="form-control" required>
              <option value="">-- Sin selección --</option>
              <option value="texto" {{ old('type') == 'texto' ? 'selected' : '' }}>Texto</option>
              <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Audio</option>
              <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
            @error('type') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            @error('description') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="date" class="form-label">Date</label>
            <input name="date" type="date" id="date" class="form-control" value="{{ old('date') }}">
            @error('date') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="identifier" class="form-label">Identifier</label>
            <input name="identifier" type="text" id="identifier" class="form-control" placeholder="ISBN" value="{{ old('identifier') }}">
            @error('identifier') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="language" class="form-label">Language</label>
            <input name="language" type="text" id="language" class="form-control" value="{{ old('language') }}">
            @error('language') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="format" class="form-label">Format</label>
            <input name="format" type="text" id="format" class="form-control" placeholder="Físico" value="{{ old('format') }}">
            @error('format') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="rights" class="form-label">Rights</label>
            <input name="rights" type="text" id="rights" class="form-control" placeholder="Derechos reservados" value="{{ old('rights') }}">
            @error('rights') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="id_publisher" class="form-label">Publisher</label>
            <select name="id_publisher" id="id_publisher" class="form-control">
              <option value="">-- Sin selección --</option>
              @foreach($publishers as $pub)
                <option value="{{ $pub->id_publisher }}" {{ old('id_publisher') == $pub->id_publisher ? 'selected' : '' }}>
                  {{ $pub->publisher }}
                </option>
              @endforeach
            </select>
            @error('id_publisher') <div class="error">{{ $message }}</div> @enderror
          </div>

          {{-- Creadores --}}
          <div class="form-group">
            <label for="creator-input" class="form-label d-flex justify-content-between align-items-center">
              <span>Creators*</span>
              <a href="{{ url('bibliotecario/creators') }}" class="btn btn-sm btn-secondary">...</a>
            </label>
            <input list="creators-list" id="creator-input" class="form-control" placeholder="Escribí para buscar...">
            <datalist id="creators-list">
              @foreach($creators as $creator)
                <option value="{{ $creator->id_creator }}::{{ $creator->creator }}"></option>
              @endforeach
            </datalist>
            @error('creators') <div class="error">{{ $message }}</div> @enderror
            @error('creators.*') <div class="error">{{ $message }}</div> @enderror
            <div id="creators-tags" class="multi-select-tags"></div>
          </div>

          {{-- Asuntos --}}
          <div class="form-group">
            <label for="subject-input" class="form-label d-flex justify-content-between align-items-center">
              <span>Subjects</span>
              <a href="{{ url('bibliotecario/subjects') }}" class="btn btn-sm btn-secondary">...</a>
            </label>
            <input list="subjects-list" id="subject-input" class="form-control" placeholder="Escribí para buscar...">
            <datalist id="subjects-list">
              @foreach($subjects as $subject)
                <option value="{{ $subject->id_subject }}::{{ $subject->subject }}"></option>
              @endforeach
            </datalist>
            @error('subjects') <div class="error">{{ $message }}</div> @enderror
            @error('subjects.*') <div class="error">{{ $message }}</div> @enderror
            <div id="subjects-tags" class="multi-select-tags"></div>
          </div>

          {{-- Bibliotecario oculto --}}
          <input type="hidden" name="id_bibliotecario" value="{{ auth()->user()->id_bibliotecario ?? 1 }}">

          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      setupDatalistTagField('creator-input', 'creators-tags', 'creators[]');
      setupDatalistTagField('subject-input', 'subjects-tags', 'subjects[]');

      function setupDatalistTagField(inputId, tagsContainerId, hiddenName) {
        const input = document.getElementById(inputId);
        const tagsContainer = document.getElementById(tagsContainerId);

        input.addEventListener('change', () => {
          const [id, label] = input.value.split('::');
          if (!id || !label) return;

          if ([...tagsContainer.querySelectorAll('input')].some(h => h.value === id)) {
            input.value = '';
            return;
          }

          const errorDiv = tagsContainer.parentNode.querySelector('.error');
          if (errorDiv) errorDiv.remove();

          const tagEl = document.createElement('span');
          tagEl.className = 'tag';
          tagEl.textContent = label;

          const removeBtn = document.createElement('button');
          removeBtn.type = 'button';
          removeBtn.textContent = '×';
          removeBtn.className = 'remove-btn';
          removeBtn.addEventListener('click', () => {
            tagsContainer.removeChild(tagEl);
          });

          tagEl.appendChild(removeBtn);

          const hidden = document.createElement('input');
          hidden.type = 'hidden';
          hidden.name = hiddenName;
          hidden.value = id;
          tagEl.appendChild(hidden);

          tagsContainer.appendChild(tagEl);
          input.value = '';
        });
      }
    });
  </script>
</body>
</html>
