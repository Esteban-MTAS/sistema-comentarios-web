<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Comentarios | ITLA</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />

    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
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
    <div class="container main-container">
      <div class="text-center mb-5">
        <span class="navbar-brand mb-0 h1">💬 Sistema de Comentarios</span>
        <h1 class="display-5 fw-bold text-dark">Su opinión es importante</h1>
        <p class="text-muted">Déjanos tus comentarios sobre el sistema</p>
      </div>

      <div class="card card-form p-4 mb-5">
        <form action="procesar.php" method="POST">
          <div class="mb-4">
            <label for="nombre" class="form-label fw-semibold">Su nombre</label>
            <div class="input-group">
              <span class="input-group-text bg-light"
                ><i class="bi bi-person-fill"></i
              ></span>
              <input
                type="text"
                name="nombre"
                id="nombre"
                class="form-control"
                placeholder="Escriba su nombre completo"
                required
              />
            </div>
          </div>

          <div class="mb-4">
            <label for="comentario" class="form-label fw-semibold"
              >Comentario</label
            >
            <textarea
              name="comentario"
              id="comentario"
              class="form-control"
              rows="4"
              placeholder="¿Qué tienes en mente?"
              required
            ></textarea>
          </div>

          <button
            type="submit"
            class="btn btn-primary btn-send w-100 shadow-sm"
          >
            Enviar Comentario <i class="bi bi-send-fill ms-2"></i>
          </button>
        </form>
      </div>

      <div class="d-flex align-items-center mb-4">
        <h3 class="h5 mb-0 text-dark fw-bold">Comentarios recibidos</h3>
      </div>

      <div id="contenedor-comentarios">
        <div class="comment-box shadow-sm">
          <div class="user-name">
            <i class="bi bi-person-circle text-secondary"></i> Daniel Parra
          </div>
          <p class="mb-0 text-muted">probando el sistema</p>
        </div>

    <footer class="py-4 text-center text-muted border-top mt-5">
      <small>&copy; 2026 ITLA - Proyecto Grupal-2-C [session: 2]</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
