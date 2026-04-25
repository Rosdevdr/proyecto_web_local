<?php
$title = "Inicio — Página & Letra";
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

try {
    $stmt = $db->query("SELECT COUNT(*) as total FROM titulos WHERE contrato = '1'");
    $total_libros = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $stmt = $db->query("SELECT COUNT(*) as total FROM autores");
    $total_autores = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $stmt = $db->query("SELECT titulo, tipo, precio, fecha_pub FROM titulos WHERE contrato = '1' ORDER BY fecha_pub DESC LIMIT 3");
    $libros_recientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $total_libros = 0;
    $total_autores = 0;
    $libros_recientes = [];
}

include 'includes/header.php';
?>

<!-- Hero -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="hero-eyebrow">Librería independiente · Est. 1999</span>
                <h1>Descubre tu próxima <em>gran lectura</em></h1>
                <div class="hero-divider"></div>
                <p class="lead">Una colección cuidadosamente seleccionada de obras literarias que inspiran, emocionan y transforman.</p>
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <a href="libros.php" class="btn-gold">Explorar catálogo</a>
                    <a href="autores.php" class="btn-outline-cream">Conocer autores</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats strip -->
<div class="stats-strip">
    <div class="container">
        <div class="row g-0">
            <div class="col-4 stat-item">
                <span class="stat-number"><?php echo $total_libros; ?></span>
                <span class="stat-label">Títulos disponibles</span>
            </div>
            <div class="col-4 stat-item" style="border-left:1px solid rgba(0,0,0,0.1); border-right:1px solid rgba(0,0,0,0.1);">
                <span class="stat-number"><?php echo $total_autores; ?></span>
                <span class="stat-label">Autores destacados</span>
            </div>
            <div class="col-4 stat-item">
                <span class="stat-number">25+</span>
                <span class="stat-label">Años de experiencia</span>
            </div>
        </div>
    </div>
</div>

<!-- Libros recientes -->
<?php if (!empty($libros_recientes)): ?>
<section class="section">
    <div class="container">
        <span class="section-label">Novedades</span>
        <h2 class="section-title">Últimas incorporaciones</h2>
        <div class="title-rule"></div>
        <div class="row g-4">
            <?php foreach ($libros_recientes as $libro): ?>
            <div class="col-md-4">
                <div class="book-card">
                    <span class="book-type-badge"><?php echo ucfirst(str_replace('_', ' ', $libro['tipo'])); ?></span>
                    <h5><?php echo htmlspecialchars($libro['titulo']); ?></h5>
                    <div class="book-meta">
                        <i class="fas fa-calendar-alt me-1"></i>
                        <?php echo date('d/m/Y', strtotime($libro['fecha_pub'])); ?>
                    </div>
                    <?php if ($libro['precio']): ?>
                    <div class="book-price">$<?php echo number_format($libro['precio'], 2); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Por qué elegirnos -->
<section class="section section-alt">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Nuestra promesa</span>
            <h2 class="section-title">¿Por qué elegirnos?</h2>
            <div class="title-rule mx-auto"></div>
        </div>
        <div class="row g-0">
            <div class="col-md-4">
                <div class="feature-item" style="border-left:none;">
                    <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                    <h5>Envío rápido</h5>
                    <p>Entregamos tus libros favoritos en tiempo récord a cualquier punto del país.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-medal"></i></div>
                    <h5>Calidad garantizada</h5>
                    <p>Solo los mejores títulos, seleccionados por nuestro equipo editorial.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-headset"></i></div>
                    <h5>Soporte 24/7</h5>
                    <p>Estamos disponibles en todo momento para ayudarte con cualquier consulta.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section" style="padding:0;">
    <div class="container-fluid p-0">
        <div class="cta-banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3>¿Tienes alguna consulta?</h3>
                        <p>Nuestro equipo está listo para orientarte en tu próxima elección literaria.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="contacto.php" class="btn-gold">Escríbenos ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>