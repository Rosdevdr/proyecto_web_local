<?php
$title = "Autores — Página & Letra";
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

try {
    $stmt = $db->query("SELECT * FROM autores ORDER BY apellido ASC");
    $autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_autores = count($autores);
} catch (PDOException $e) {
    $autores = [];
    $total_autores = 0;
}

include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="eyebrow">Nuestros escritores</span>
        <h1>Autores registrados</h1>
        <p><?php echo $total_autores; ?> autores en nuestro catálogo</p>
    </div>
</div>

<section class="section">
    <div class="container">

        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchAuthors" placeholder="Buscar por nombre, ciudad o país…">
        </div>

        <?php if (!empty($autores)): ?>
        <div class="table-wrapper">
            <table class="table table-hover" id="autoresTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Ciudad</th>
                        <th>País</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td style="color:var(--muted); font-size:0.8rem;"><?php echo htmlspecialchars($autor['id_autor']); ?></td>
                        <td style="font-weight:500;"><?php echo htmlspecialchars(trim($autor['nombre'])); ?></td>
                        <td style="font-family:'Playfair Display',serif;"><?php echo htmlspecialchars(trim($autor['apellido'])); ?></td>
                        <td><?php echo htmlspecialchars($autor['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($autor['ciudad']); ?></td>
                        <td><?php echo htmlspecialchars($autor['pais']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-warning text-center"><i class="fas fa-info-circle me-2"></i>No hay autores disponibles.</div>
        <?php endif; ?>

    </div>
</section>

<?php include 'includes/footer.php'; ?>