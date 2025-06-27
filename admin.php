<?php
require_once 'config.php';

// Procesar cambio de estado
if ($_POST && isset($_POST['cambiar_estado'])) {
    $id = $_POST['id'];
    $nuevo_estado = $_POST['nuevo_estado'];
    
    $pdo = conectarDB();
    $stmt = $pdo->prepare("UPDATE solicitudes SET estado = ? WHERE id = ?");
    $stmt->execute([$nuevo_estado, $id]);
    
    header("Location: admin.php");
    exit;
}

$mostrar_completadas = isset($_GET['mostrar_completadas']) ? $_GET['mostrar_completadas'] : '0';

$pdo = conectarDB();
if ($mostrar_completadas == '1') {
    $stmt = $pdo->query("SELECT * FROM solicitudes ORDER BY tiempo DESC");
} else {
    $stmt = $pdo->query("SELECT * FROM solicitudes WHERE estado != 'completada' ORDER BY tiempo DESC");
}
$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzón CAU - Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .estado-pendiente { background-color: #fff3cd; }
        .estado-en_proceso { background-color: #cce5ff; }
        .estado-completada { background-color: #d4edda; }
        .estado-rechazada { background-color: #f8d7da; }
        .card { margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; }
        .admin-badge { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); }
        /* Switch verde para mostrar completadas */
        .form-switch .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }
        .form-switch .form-check-label {
            color: #212529;
            font-weight: 500;
            transition: color 0.2s;
        }
        .form-switch .form-check-input:checked + .form-check-label {
            color: #198754;
        }
    </style>
</head>
<body>
    <div class="header py-4 mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">
                    <i class="fas fa-shield-alt me-2"></i>
                    Panel de Administración - Buzón CAU
                </h1>
                <div class="d-flex gap-2">
                    <a href="index.php" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-home me-1"></i>Página Principal
                    </a>
                    <a href="nueva_solicitud.php" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-plus me-1"></i>Nueva Solicitud
                    </a>
                </div>
            </div>
            <div class="text-center mt-2">
                <span class="badge admin-badge fs-6">
                    <i class="fas fa-user-shield me-1"></i>Modo Administrador
                </span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>
                        <i class="fas fa-list me-2"></i>
                        Gestión de Solicitudes
                    </h2>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="mostrarCompletadas" 
                                   onchange="toggleCompletadas()" <?php echo $mostrar_completadas == '1' ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="mostrarCompletadas">
                                <i class="fas fa-eye me-1"></i>Mostrar Completadas
                            </label>
                        </div>
                        <span class="badge bg-primary fs-6">
                            <i class="fas fa-chart-bar me-1"></i>
                            Total: <?php echo count($solicitudes); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <?php if (empty($solicitudes)): ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                No hay solicitudes registradas
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($solicitudes as $solicitud): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card estado-<?php echo $solicitud['estado']; ?>">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-user me-2"></i><?php echo htmlspecialchars($solicitud['nombre']); ?>
                                    <?php if ($solicitud['urgente'] == 1): ?>
                                        <span class="badge bg-danger ms-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Urgente
                                        </span>
                                    <?php endif; ?>
                                </h6>
                                <span class="badge bg-<?php 
                                    echo $solicitud['estado'] == 'pendiente' ? 'warning' : 
                                        ($solicitud['estado'] == 'en_proceso' ? 'info' : 
                                        ($solicitud['estado'] == 'completada' ? 'success' : 'danger')); 
                                ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $solicitud['estado'])); ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="fas fa-tag me-2"></i><?php echo htmlspecialchars($solicitud['asunto']); ?>
                                </h6>
                                <p class="card-text">
                                    <i class="fas fa-align-left me-2"></i>
                                    <?php echo htmlspecialchars(substr($solicitud['descripcion'], 0, 100)) . (strlen($solicitud['descripcion']) > 100 ? '...' : ''); ?>
                                </p>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    <?php echo date('d/m/Y H:i', strtotime($solicitud['tiempo'])); ?>
                                </small>
                            </div>
                            <div class="card-footer">
                                <form method="POST" class="d-flex gap-2">
                                    <input type="hidden" name="id" value="<?php echo $solicitud['id']; ?>">
                                    <select name="nuevo_estado" class="form-select form-select-sm">
                                        <option value="pendiente" <?php echo $solicitud['estado'] == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                        <option value="en_proceso" <?php echo $solicitud['estado'] == 'en_proceso' ? 'selected' : ''; ?>>En Proceso</option>
                                        <option value="completada" <?php echo $solicitud['estado'] == 'completada' ? 'selected' : ''; ?>>Completada</option>
                                        <option value="rechazada" <?php echo $solicitud['estado'] == 'rechazada' ? 'selected' : ''; ?>>Rechazada</option>
                                    </select>
                                    <button type="submit" name="cambiar_estado" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-sm btn-outline-info mt-2 w-100" 
                                        onclick="verDetalle(<?php echo $solicitud['id']; ?>)">
                                    <i class="fas fa-eye me-1"></i>Ver Detalle
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal para ver detalles -->
    <div class="modal fade" id="detalleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle de la Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detalleContenido">
                    <!-- El contenido se cargará dinámicamente -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function verDetalle(id) {
            fetch('detalle_solicitud.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('detalleContenido').innerHTML = data;
                    new bootstrap.Modal(document.getElementById('detalleModal')).show();
                });
        }
        
        function toggleCompletadas() {
            const checkbox = document.getElementById('mostrarCompletadas');
            const mostrar = checkbox.checked ? '1' : '0';
            window.location.href = 'admin.php?mostrar_completadas=' + mostrar;
        }
    </script>
</body>
</html> 