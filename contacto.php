<?php
$title = "Contacto — Página & Letra";
include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="eyebrow">Estamos para ayudarte</span>
        <h1>Contáctanos</h1>
        <p>Completa el formulario y te respondemos a la brevedad</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <?php if (isset($_GET['success'])): ?>
                <div class="alert" style="background:rgba(201,168,76,0.1); border:1px solid var(--gold-light); color:var(--ink); border-radius:0; margin-bottom:2rem;">
                    <i class="fas fa-check-circle me-2" style="color:var(--gold);"></i>
                    <strong>¡Mensaje enviado!</strong> Te responderemos pronto.
                </div>
                <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger" style="border-radius:0; margin-bottom:2rem;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Ocurrió un error. Por favor intenta nuevamente.
                </div>
                <?php endif; ?>

                <div class="contact-form">
                    <form id="contactForm" action="procesar_contacto.php" method="POST">
                        <div class="mb-4">
                            <label for="nombre" class="form-label">Nombre completo</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Tu nombre">
                        </div>
                        <div class="mb-4">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" name="correo" id="correo" class="form-control" required placeholder="correo@ejemplo.com">
                        </div>
                        <div class="mb-4">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" name="asunto" id="asunto" class="form-control" required placeholder="¿En qué podemos ayudarte?">
                        </div>
                        <div class="mb-4">
                            <label for="comentario" class="form-label">Mensaje</label>
                            <textarea name="comentario" id="comentario" rows="5" class="form-control" required placeholder="Escribe tu mensaje aquí…"></textarea>
                        </div>
                        <button type="submit" class="btn-gold w-100" style="border:none; cursor:pointer; width:100%; text-align:center;">
                            <i class="fas fa-paper-plane me-2"></i> Enviar mensaje
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="loading">
    <div class="spinner-border" style="color:var(--gold);" role="status"></div>
    <p class="mt-2" style="font-size:0.85rem; color:var(--muted);">Enviando…</p>
</div>

<?php include 'includes/footer.php'; ?>