<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    echo '<div class="alert alert-danger">ID de solicitud no proporcionado</div>';
    exit;
}

$id = $_GET['id'];
$pdo = conectarDB();
$stmt = $pdo->prepare("SELECT * FROM solicitudes WHERE id = ?");
$stmt->execute([$id]);
$solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$solicitud) {
    echo '<div class="alert alert-danger">Solicitud no encontrada</div>';
    exit;
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <h6><i class="fas fa-user me-2"></i><strong>Nombre:</strong></h6>
            <p class="ms-4"><?php echo htmlspecialchars($solicitud['nombre']); ?></p>
        </div>
        
        <div class="mb-3">
            <h6><i class="fas fa-tag me-2"></i><strong>Asunto:</strong></h6>
            <p class="ms-4"><?php echo htmlspecialchars($solicitud['asunto']); ?></p>
        </div>
        
        <div class="mb-3">
            <h6><i class="fas fa-align-left me-2"></i><strong>Descripción:</strong></h6>
            <div class="ms-4 p-3 bg-light rounded">
                <?php echo nl2br(htmlspecialchars($solicitud['descripcion'])); ?>
            </div>
        </div>
        
        <div class="mb-3">
            <h6><i class="fas fa-exclamation-triangle me-2"></i><strong>Prioridad:</strong></h6>
            <p class="ms-4">
                <?php if ($solicitud['urgente'] == 1): ?>
                    <span class="badge bg-danger fs-6">
                        <i class="fas fa-exclamation-triangle me-1"></i>Urgente
                    </span>
                    <small class="text-muted ms-2">Se atiende en 24-48 horas</small>
                <?php else: ?>
                    <span class="badge bg-secondary fs-6">
                        <i class="fas fa-clock me-1"></i>Normal
                    </span>
                    <small class="text-muted ms-2">Se atiende en 3-5 días hábiles</small>
                <?php endif; ?>
            </p>
        </div>
        
        <div class="mb-3">
            <h6><i class="fas fa-clock me-2"></i><strong>Fecha y Hora:</strong></h6>
            <p class="ms-4"><?php echo date('d/m/Y H:i:s', strtotime($solicitud['tiempo'])); ?></p>
        </div>
        
        <div class="mb-3">
            <h6><i class="fas fa-info-circle me-2"></i><strong>Estado Actual:</strong></h6>
            <span class="ms-4 badge bg-<?php 
                echo $solicitud['estado'] == 'pendiente' ? 'warning' : 
                    ($solicitud['estado'] == 'en_proceso' ? 'info' : 
                    ($solicitud['estado'] == 'completada' ? 'success' : 'danger')); 
            ?> fs-6">
                <?php echo ucfirst(str_replace('_', ' ', $solicitud['estado'])); ?>
            </span>
        </div>
    </div>
</div>

<div class="mt-4 pt-3 border-top">
    <h6><i class="fas fa-history me-2"></i><strong>Cambiar Estado:</strong></h6>
    <form method="POST" action="admin.php" class="mt-2">
        <input type="hidden" name="id" value="<?php echo $solicitud['id']; ?>">
        <div class="row">
            <div class="col-md-8">
                <select name="nuevo_estado" class="form-select">
                    <option value="pendiente" <?php echo $solicitud['estado'] == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="en_proceso" <?php echo $solicitud['estado'] == 'en_proceso' ? 'selected' : ''; ?>>En Proceso</option>
                    <option value="completada" <?php echo $solicitud['estado'] == 'completada' ? 'selected' : ''; ?>>Completada</option>
                    <option value="rechazada" <?php echo $solicitud['estado'] == 'rechazada' ? 'selected' : ''; ?>>Rechazada</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" name="cambiar_estado" class="btn btn-primary w-100">
                    <i class="fas fa-save me-2"></i>Actualizar
                </button>
            </div>
        </div>
    </form>
</div> 