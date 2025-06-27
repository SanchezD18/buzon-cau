<?php
require_once 'config.php';

$mensaje = '';

if ($_POST) {
    $nombre = trim($_POST['nombre']);
    $asunto = trim($_POST['asunto']);
    $descripcion = trim($_POST['descripcion']);
    $urgente = isset($_POST['urgente']) ? 1 : 0;
    
    if (empty($nombre) || empty($asunto) || empty($descripcion)) {
        $mensaje = '<div class="alert alert-danger">Todos los campos son obligatorios</div>';
    } else {
        $pdo = conectarDB();
        $stmt = $pdo->prepare("INSERT INTO solicitudes (nombre, asunto, descripcion, urgente) VALUES (?, ?, ?, ?)");
        
        if ($stmt->execute([$nombre, $asunto, $descripcion, $urgente])) {
            $mensaje = '<div class="alert alert-success">Solicitud enviada correctamente</div>';
            $_POST = array();
        } else {
            $mensaje = '<div class="alert alert-danger">Error al enviar la solicitud</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud - Buzón CAU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .form-container { max-width: 600px; margin: 0 auto; }
        .urgente-checkbox { background-color: #fff3cd; border: 2px solid #ffc107; }
    </style>
</head>
<body>
    <div class="header py-4 mb-4">
        <div class="container">
            <h1 class="text-center mb-0">
                <i class="fas fa-plus-circle me-2"></i>
                Nueva Solicitud
            </h1>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Formulario de Solicitud
                    </h5>
                </div>
                <div class="card-body">
                    <?php echo $mensaje; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">
                                <i class="fas fa-user me-2"></i>Nombre Completo
                            </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="asunto" class="form-label">
                                <i class="fas fa-tag me-2"></i>Asunto
                            </label>
                            <input type="text" class="form-control" id="asunto" name="asunto" 
                                   value="<?php echo isset($_POST['asunto']) ? htmlspecialchars($_POST['asunto']) : ''; ?>" 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">
                                <i class="fas fa-align-left me-2"></i>Descripción
                            </label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" 
                                      required><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?></textarea>
                            <div class="form-text">Describe detalladamente tu solicitud o consulta</div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input me-2" type="checkbox" id="urgente" name="urgente" value="1" <?php echo isset($_POST['urgente']) ? 'checked' : ''; ?>>
                                <label class="form-check-label fw-bold mb-0 d-flex align-items-center" for="urgente" style="font-size: 1.1rem;">
                                    <span style="font-size:1.3em;" class="me-2">⚡</span>
                                    Urgente
                                </label>
                            </div>
                            <div class="alert alert-warning mt-2 mb-0 py-2 px-3" style="font-size:0.95em;">
                                <i class="fas fa-info-circle me-1"></i>
                                Las solicitudes urgentes tienen prioridad y se atienden en 24-48 horas
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left me-2"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Enviar Solicitud
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 