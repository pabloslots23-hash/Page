<?php
session_start();
require_once '../php/config.php';
require_once '../php/admin-auth.php';

// Verificar autenticación
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

// Obtener estadísticas (simuladas)
$total_orders = 42;
$total_products = 6;
$total_revenue = 2845.50;
$pending_orders = 3;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - VOURNE Admin</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-dashboard">
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h2>VOURNE</h2>
                <p>Admin Panel</p>
            </div>
            
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="nav-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="products.php" class="nav-item">
                    <i class="fas fa-tshirt"></i>
                    <span>Productos</span>
                </a>
                <a href="orders.php" class="nav-item">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Pedidos</span>
                </a>
                <a href="settings.php" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Configuración</span>
                </a>
                <a href="../index.html" class="nav-item">
                    <i class="fas fa-store"></i>
                    <span>Ver Tienda</span>
                </a>
                <a href="?logout=1" class="nav-item logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <h1>Dashboard</h1>
                <div class="admin-user">
                    <span>Hola, <?php echo $_SESSION['admin_username']; ?></span>
                </div>
            </header>

            <div class="admin-content">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $total_orders; ?></h3>
                            <p>Total Pedidos</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $total_products; ?></h3>
                            <p>Productos</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-euro-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($total_revenue, 2); ?>€</h3>
                            <p>Ingresos Totales</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $pending_orders; ?></h3>
                            <p>Pedidos Pendientes</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="content-grid">
                    <div class="content-card">
                        <h3>Actividad Reciente</h3>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon success">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Nuevo pedido #VOURNE-12345</strong></p>
                                    <span>Hace 2 horas - 129.00€</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon info">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Nuevo usuario registrado</strong></p>
                                    <span>Hace 4 horas - maria@email.com</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Stock bajo: Parka Técnica</strong></p>
                                    <span>Quedan 5 unidades</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3>Pedidos Recientes</h3>
                        <div class="orders-list">
                            <div class="order-item">
                                <div class="order-info">
                                    <strong>#VOURNE-12344</strong>
                                    <span>Maria García</span>
                                </div>
                                <div class="order-status delivered">
                                    Entregado
                                </div>
                                <div class="order-amount">
                                    89.00€
                                </div>
                            </div>
                            <div class="order-item">
                                <div class="order-info">
                                    <strong>#VOURNE-12343</strong>
                                    <span>Carlos López</span>
                                </div>
                                <div class="order-status processing">
                                    Procesando
                                </div>
                                <div class="order-amount">
                                    149.90€
                                </div>
                            </div>
                            <div class="order-item">
                                <div class="order-info">
                                    <strong>#VOURNE-12342</strong>
                                    <span>Ana Martínez</span>
                                </div>
                                <div class="order-status pending">
                                    Pendiente
                                </div>
                                <div class="order-amount">
                                    59.99€
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="content-card">
                    <h3>Acciones Rápidas</h3>
                    <div class="quick-actions">
                        <a href="products.php?action=new" class="btn btn--primary">
                            <i class="fas fa-plus"></i>
                            Añadir Producto
                        </a>
                        <a href="orders.php" class="btn btn--secondary">
                            <i class="fas fa-list"></i>
                            Ver Todos los Pedidos
                        </a>
                        <a href="settings.php" class="btn btn--secondary">
                            <i class="fas fa-cog"></i>
                            Configuración
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php
    // Logout
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
        exit;
    }
    ?>
</body>
</html>