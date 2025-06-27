<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzón CAU - Centro de Atención al Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .feature-card { transition: transform 0.3s ease; }
        .feature-card:hover { transform: translateY(-5px); }
        .hero-section { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); }
    </style>
</head>
<body>
    <div class="header py-4 mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">
                    <i class="fas fa-inbox me-2"></i>
                    Buzón CAU
                </h1>
            </div>
            <p class="text-center mb-0 mt-2">
                <i class="fas fa-info-circle me-1"></i>
                Centro de Atención al Usuario
            </p>
        </div>
    </div>

    <div class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4">
                        ¿Necesitas ayuda?
                    </h2>
                    <p class="lead mb-4">
                        Nuestro equipo está aquí para ayudarte. Envía tu solicitud o consulta y te responderemos lo antes posible.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="nueva_solicitud.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Nueva Solicitud
                        </a>
                        <a href="#servicios" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-info me-2"></i>Ver Servicios
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-headset" style="font-size: 8rem; color: #667eea; opacity: 0.7;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5" id="servicios">
        <h3 class="text-center mb-5">
            <i class="fas fa-cogs me-2"></i>
            Nuestros Servicios
        </h3>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-question-circle fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Consultas Generales</h5>
                        <p class="card-text">
                            Resolvemos todas tus dudas sobre nuestros servicios y procedimientos.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-tools fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Soporte Técnico</h5>
                        <p class="card-text">
                            Asistencia técnica especializada para resolver problemas y configuraciones.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-clipboard-list fa-3x text-warning mb-3"></i>
                        <h5 class="card-title">Solicitudes Especiales</h5>
                        <p class="card-text">
                            Gestión de solicitudes especiales y requerimientos personalizados.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h4 class="mb-4">
                        <i class="fas fa-clock me-2"></i>
                        Tiempos de Respuesta
                    </h4>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body">
                                    <i class="fas fa-bolt fa-2x text-warning mb-2"></i>
                                    <h6>Urgente</h6>
                                    <p class="small text-muted">24-48 horas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body">
                                    <i class="fas fa-clock fa-2x text-info mb-2"></i>
                                    <h6>Normal</h6>
                                    <p class="small text-muted">3-5 días hábiles</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body">
                                    <i class="fas fa-calendar fa-2x text-success mb-2"></i>
                                    <h6>Programado</h6>
                                    <p class="small text-muted">Según agenda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">
                <i class="fas fa-heart text-danger me-1"></i>
                Buzón CAU - Centro de Atención al Usuario
            </p>
            <small class="text-muted">
                Estamos aquí para ayudarte
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 