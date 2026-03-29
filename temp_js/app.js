document.addEventListener("DOMContentLoaded", () => {
  cargarComentarios();

  const form = document.getElementById("form-comentario");
  if (form) form.addEventListener("submit", manejarEnvio);
});

async function manejarEnvio(e) {
  e.preventDefault();

  const form = e.target;
  const nombre = document.getElementById("nombre");
  const comentario = document.getElementById("comentario");
  const btnEnviar = document.getElementById("btn-enviar");
  const alerta = document.getElementById("alerta-form");

  limpiarErrores();

  let valido = true;

  if (!nombre.value.trim()) {
    mostrarError(nombre, "El nombre es obligatorio.");
    valido = false;
  } else if (nombre.value.trim().length < 2) {
    mostrarError(nombre, "El nombre debe tener al menos 2 caracteres.");
    valido = false;
  }

  if (!comentario.value.trim()) {
    mostrarError(comentario, "El comentario no puede estar vacío.");
    valido = false;
  } else if (comentario.value.trim().length < 5) {
    mostrarError(comentario, "El comentario debe tener al menos 5 caracteres.");
    valido = false;
  } else if (comentario.value.trim().length > 500) {
    mostrarError(comentario, "Máximo 500 caracteres.");
    valido = false;
  }

  if (!valido) return;

  btnEnviar.disabled = true;
  btnEnviar.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Enviando...';

  try {
    const respuesta = await fetch("actions/guardar_comentario.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        nombre: nombre.value.trim(),
        comentario: comentario.value.trim()
      })
    });

    const resultado = await respuesta.json();

    if (resultado.success) {
      mostrarAlerta(alerta, "✅ ¡Comentario publicado correctamente!", "success");
      form.reset();
      document.getElementById("contador-chars").textContent = "0 / 500";
      cargarComentarios();
    } else {
      mostrarAlerta(alerta, resultado.message || "No se pudo guardar el comentario.", "danger");
    }
  } catch (error) {
    mostrarAlerta(alerta, "❌ Error de conexión con el servidor.", "danger");
    console.error("Error al enviar:", error);
  } finally {
    btnEnviar.disabled = false;
    btnEnviar.innerHTML = 'Enviar Comentario <i class="bi bi-send-fill ms-2"></i>';
  }
}

async function cargarComentarios() {
  const contenedor = document.getElementById("contenedor-comentarios");
  if (!contenedor) return;

  contenedor.innerHTML = `
    <div class="text-center py-4 text-muted">
      <div class="spinner-border spinner-border-sm me-2"></div> Cargando comentarios...
    </div>`;

  try {
    const respuesta = await fetch("actions/consultas.php");
    const comentarios = await respuesta.json();

    if (!Array.isArray(comentarios) || comentarios.length === 0) {
      contenedor.innerHTML = `
        <div class="text-center py-4 text-muted">
          <i class="bi bi-chat-dots fs-2 d-block mb-2"></i>
          Aún no hay comentarios. ¡Sé el primero!
        </div>`;
      return;
    }

    contenedor.innerHTML = [...comentarios].reverse().map(crearTarjetaComentario).join("");

    contenedor.querySelectorAll(".comment-box").forEach((el, i) => {
      el.style.opacity = "0";
      el.style.transform = "translateY(12px)";
      setTimeout(() => {
        el.style.transition = "opacity 0.3s ease, transform 0.3s ease";
        el.style.opacity = "1";
        el.style.transform = "translateY(0)";
      }, i * 80);
    });
  } catch (error) {
    contenedor.innerHTML = `
      <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>
        No se pudieron cargar los comentarios.
      </div>`;
    console.error("Error al cargar:", error);
  }
}

function crearTarjetaComentario({ nombre, comentario, fecha }) {
  const fechaStr = fecha
    ? new Date(fecha).toLocaleString("es-DO", {
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit"
      })
    : "";

  return `
    <div class="comment-box shadow-sm">
      <div class="d-flex justify-content-between align-items-start mb-1">
        <div class="user-name">
          <i class="bi bi-person-circle text-secondary"></i> ${escaparHTML(nombre)}
        </div>
        ${fechaStr ? `<small class="text-muted" style="font-size:0.75rem;">${fechaStr}</small>` : ""}
      </div>
      <p class="mb-0 text-muted">${escaparHTML(comentario)}</p>
    </div>`;
}

function mostrarError(input, msg) {
  input.classList.add("is-invalid");
  const d = document.createElement("div");
  d.className = "invalid-feedback";
  d.textContent = msg;
  input.parentElement.appendChild(d);
}

function limpiarErrores() {
  document.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
  document.querySelectorAll(".invalid-feedback").forEach(el => el.remove());
}

function mostrarAlerta(el, msg, tipo) {
  el.className = `alert alert-${tipo} mt-3`;
  el.textContent = msg;
  el.classList.remove("d-none");
  setTimeout(() => el.classList.add("d-none"), 5000);
}

function escaparHTML(str) {
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");
}