<?php
$title = "Catálogo — Página & Letra";
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

try {
    $query = "SELECT t.*, p.nombre_pub 
              FROM titulos t 
              LEFT JOIN publicadores p ON t.id_pub = p.id_pub 
              WHERE t.contrato = '1' 
              ORDER BY t.titulo ASC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_libros = count($libros);
} catch(PDOException $e) {
    $libros = [];
    $total_libros = 0;
    $error_message = "Error al cargar los libros.";
}

include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="eyebrow">Catálogo completo</span>
        <h1>Nuestros libros</h1>
        <p><?php echo $total_libros; ?> títulos disponibles</p>
    </div>
</div>

<section class="section">
    <div class="container">

        <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchBooks" placeholder="Buscar por título, tipo o editorial…">
        </div>

        <?php if (!empty($libros)): ?>
        <div class="table-wrapper">
            <table class="table" id="librosTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Publicación</th>
                        <th>Editorial</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td style="color:var(--muted); font-size:0.8rem;"><?php echo htmlspecialchars($libro['id_titulo']); ?></td>
                        <td style="font-weight:500; font-family:'Playfair Display',serif;"><?php echo htmlspecialchars($libro['titulo']); ?></td>
                        <td><span style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; font-weight:600; color:var(--gold); background:rgba(201,168,76,0.1); padding:0.2rem 0.6rem;"><?php echo ucfirst(str_replace('_', ' ', $libro['tipo'])); ?></span></td>
                        <td style="font-weight:500;"><?php echo $libro['precio'] ? '$'.number_format($libro['precio'],2) : '<span style="color:var(--muted)">—</span>'; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($libro['fecha_pub'])); ?></td>
                        <td><?php echo htmlspecialchars($libro['nombre_pub']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-warning text-center"><i class="fas fa-info-circle me-2"></i>No hay libros disponibles por el momento.</div>
        <?php endif; ?>

    </div>
</section>

<?php include 'includes/footer.php'; ?>