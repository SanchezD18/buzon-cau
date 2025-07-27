# Buzón CAU - Sistema de Gestión de Solicitudes

Sistema web para la gestión de solicitudes del Centro de Atención al Usuario (CAU) desarrollado en PHP con MySQL.

## Características

- **Interfaz de Usuario**: Página principal atractiva para usuarios que desean crear solicitudes.
- **Panel de Administración**: Gestión completa de solicitudes para administradores.
- **Formulario de Solicitudes**: Sistema simple para enviar nuevas solicitudes.
- **Gestión de Estados**: Control de estados de solicitudes (Pendiente, En Proceso, Completada, Rechazada).
- **Sistema de Prioridades**: Marcado de solicitudes urgentes con atención prioritaria.
- **Filtros Inteligentes**: Control de visibilidad de solicitudes completadas.
- **Diseño Responsivo**: Interfaz adaptada para dispositivos móviles y de escritorio.

## Estructura de Archivos

```
buzon_cau/
├── index.php              # Página principal (usuarios normales).
├── admin.php              # Panel de administración.
├── nueva_solicitud.php    # Formulario para crear solicitudes.
├── detalle_solicitud.php  # Vista detallada de solicitudes.
├── config.php             # Configuración de base de datos.
├── schema.sql             # Estructura de la base de datos.
└── README.md              # Este archivo.
```

## Rutas y Funcionalidades

### Para Usuarios Normales
- **`index.php`**: Página principal con información del CAU y enlace para crear solicitudes.
- **`nueva_solicitud.php`**: Formulario para enviar nuevas solicitudes con opción de marcar como urgente.

### Para Administradores
- **`admin.php`**: Panel completo de gestión de solicitudes.
  - Ver todas las solicitudes con indicadores de urgencia.
  - Cambiar estados de solicitudes.
  - Ver detalles completos.
  - Filtro para mostrar/ocultar solicitudes completadas.
  - Estadísticas básicas.

## Instalación

1. **Configurar XAMPP**:
   - Iniciar Apache y MySQL.
   - Colocar los archivos en `htdocs/buzon_cau/`.

2. **Base de Datos**:
   - Crear una base de datos llamada `buzon_cau`.
   - Importar el archivo `schema.sql`.

3. **Configuración**:
   - Editar `config.php` con los datos de conexión a la base de datos.

## Uso

### Acceso para Usuarios
1. Navegar a `http://localhost/buzon_cau/`.
2. Ver información del CAU y servicios disponibles.
3. Hacer clic en "Nueva Solicitud" para crear una solicitud.
4. Opcionalmente marcar la solicitud como urgente.

### Acceso para Administradores
1. Navegar directamente a `http://localhost/buzon_cau/admin.php`.
2. Gestionar todas las solicitudes existentes.
3. Cambiar estados y ver detalles completos.
4. Usar filtro para mostrar/ocultar solicitudes completadas.

## Base de Datos

La tabla `solicitudes` contiene:
- `id`: Identificador único.
- `nombre`: Nombre del solicitante.
- `asunto`: Título de la solicitud.
- `descripcion`: Detalles de la solicitud.
- `urgente`: Indicador de urgencia (0 = Normal, 1 = Urgente).
- `estado`: Estado actual (pendiente, en_proceso, completada, rechazada).
- `tiempo`: Fecha y hora de creación.

## Sistema de Prioridades

### Solicitudes Normales
- Tiempo de respuesta: 3-5 días hábiles.
- Indicador visual: Badge gris con icono de reloj.

### Solicitudes Urgentes
- Tiempo de respuesta: 24-48 horas.
- Indicador visual: Badge rojo con icono de advertencia.
- Prioridad alta en el panel de administración.

## Tecnologías Utilizadas

- **Backend**: PHP 7.4+
- **Base de Datos**: MySQL
- **Frontend**: Bootstrap 5, Font Awesome
- **Servidor**: Apache (XAMPP)

## Notas Importantes

- No se requiere sistema de autenticación.
- Los administradores acceden directamente a `admin.php`.
- Los usuarios normales solo pueden crear solicitudes.
- Las solicitudes completadas se ocultan por defecto en el panel admin.
- El sistema es completamente funcional sin login.
