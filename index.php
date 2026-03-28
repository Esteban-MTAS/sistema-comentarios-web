<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Comentarios | ITLA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="CSS/styles.css" />
  </head>
  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark shadow-sm py-2">
      <div class="container d-flex flex-column align-items-start">
        <div class="navbar-nav d-flex flex-row mb-1" style="font-size: 0.7rem; letter-spacing: 1px;">
          <a class="nav-link active pe-3 py-0" href="#">Inicio</a>
          <a class="nav-link pe-3 py-0" href="#">Tiendas</a>
          <a class="nav-link pe-3 py-0" href="#">Categorías</a>
          <a class="nav-link pe-3 py-0" href="#">Ofertas</a>
          <a class="nav-link py-0" href="#">Contactos</a>
        </div>
        <div class="d-flex flex-column">
          <a class="navbar-brand fw-bold m-0 p-0" href="#" style="font-size: 1.55rem;">
            <i class="bi bi-chat-left-text-fill me-4"></i> ITLA - Programación Web
          </a>
          <span class="text-muted" style="font-size: 1.30rem; margin-top: -2px;">
            Daniel Parra
          </span>
        </div>
      </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container main-container">

      <!-- ENCABEZADO -->
      <div class="text-center mb-5">
        <span class="navbar-brand mb-0 h1">💬 Sistema de Comentarios</span>
        <h1 class="display-5 fw-bold text-dark">Su opinión es importante</h1>
        <p class="text-muted">Déjanos tus comentarios sobre el sistema</p>
      </div>

      <!-- FORMULARIO -->
      <div class="card card-form p-4 mb-5">

        <!-- Alerta de resultado (oculta por defecto) -->
        <div id="alerta-form" class="d-none" role="alert"></div>

        <!-- ID del form actualizado para que JS lo encuentre -->
        <form id="form-comentario" novalidate>
          <div class="mb-4">
            <label for="nombre" class="form-label fw-semibold">Su nombre</label>
            <div class="input-group">
              <span class="input-group-text bg-light"><i class="bi bi-person-fill"></i></span>
              <input
                type="text"
                name="nombre"
                id="nombre"
                class="form-control"
                placeholder="Escriba su nombre completo"
                maxlength="100"
                required
              />
            </div>
          </div>

          <div class="mb-4">
            <label for="comentario" class="form-label fw-semibold">Comentario</label>
            <textarea
              name="comentario"
              id="comentario"
              class="form-control"
              rows="4"
              placeholder="¿Qué tienes en mente?"
              maxlength="500"
              required
            ></textarea>
            <!-- Contador de caracteres -->
            <div class="text-end mt-1">
              <small id="contador-chars" class="text-muted">0 / 500</small>
            </div>
          </div>

          <button type="submit" id="btn-enviar" class="btn btn-primary btn-send w-100 shadow-sm">
            Enviar Comentario <i class="bi bi-send-fill ms-2"></i>
          </button>
        </form>
      </div>

      <!-- LISTA DE COMENTARIOS -->
      <div class="d-flex align-items-center mb-4">
        <h3 class="h5 mb-0 text-dark fw-bold">
          <i class="bi bi-chat-left-dots me-2"></i>Comentarios recibidos
        </h3>
      </div>

      <!-- Los comentarios se insertan aquí dinámicamente por app.js -->
      <div id="contenedor-comentarios"></div>

    </div><!-- /container -->

    <!-- FOOTER -->
    <footer class="py-4 text-center text-muted border-top mt-5">
      <small>&copy; 2026 ITLA - Proyecto Grupal-2-C [session: 2]</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS propio (validación + carga dinámica) -->
    <script src="JS/app.js"></script>

    <!-- Contador de caracteres inline (pequeño helper) -->
    <script>
      const txtComentario = document.getElementById("comentario");
      const contador = document.getElementById("contador-chars");
      if (txtComentario && contador) {
        txtComentario.addEventListener("input", () => {
          const len = txtComentario.value.length;
          contador.textContent = `${len} / 500`;
          contador.style.color = len > 450 ? "#dc3545" : "";
        });
      }
    </script>
  </body>
</html>
