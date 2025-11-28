<?php
session_start();
require_once '../php/config.php';
require_once '../php/admin-auth.php';

// Verificar autenticación
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

// Productos de ejemplo
$products = [
    [
        'id' => 1,
        'name' => 'Parka Técnica',
        'price' => 129.00,
        'category' => 'men',
        'stock' => 15,
        'featured' => true,
        'active' => true
    ],
    [
        'id' => 2,
        'name' => 'Jersey Oversize',
        'price' => 59.90,
        'category' => 'women',
        'stock' => 25,
        'featured' => true,
        'active' => true
    ],
    [
        'id' => 3,
        'name' => 'Jeans Flare',
        'price' => 59.99,
        'category' => 'men',
        'stock' => 30,
        'featured' => true,
        'active' => true
    ],
    [
        'id' => 4,
        'name' => 'Chaqueta Mixta',
        'price' => 89.00,
        'category' => 'women',
        'stock' => 12,
        'featured' => true,
        'active' => true
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - VOURNE Admin</title>
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
                <a href="dashboard.php" class="nav-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="products.php" class="nav-item active">
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
                <h1>Gestión de Productos</h1>
                <div class="admin-actions">
                    <a href="?action=new" class="btn btn--primary">
                        <i class="fas fa-plus"></i>
                        Nuevo Producto
                    </a>
                </div>
            </header>

            <div class="admin-content">
                <!-- Products Table -->
                <div class="content-card">
                    <div class="table-header">
                        <h3>Todos los Productos</h3>
                        <div class="table-actions">
                            <input type="text" placeholder="Buscar productos..." class="search-input">
                            <select class="filter-select">
                                <option value="all">Todas las categorías</option>
                                <option value="men">Hombre</option>
                                <option value="women">Mujer</option>
                                <option value="accessories">Accesorios</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Destacado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td>
                                        <div class="product-info">
                                            <img src="../assets/images/products/product-<?php echo $product['id']; ?>.jpg" 
                                                 alt="<?php echo $product['name']; ?>" 
                                                 class="product-thumb">
                                            <span><?php echo $product['name']; ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge category-<?php echo $product['category']; ?>">
                                            <?php echo ucfirst($product['category']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo number_format($product['price'], 2); ?>€</td>
                                    <td>
                                        <span class="stock-badge <?php echo $product['stock'] < 10 ? 'low-stock' : 'in-stock'; ?>">
                                            <?php echo $product['stock']; ?> unidades
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge <?php echo $product['active'] ? 'active' : 'inactive'; ?>">
                                            <?php echo $product['active'] ? 'Activo' : 'Inactivo'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <label class="toggle-switch">
                                            <input type="checkbox" <?php echo $product['featured'] ? 'checked' : ''; ?>>
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="table-footer">
                        <div class="pagination">
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <span>...</span>
                            <button class="pagination-btn">Siguiente</button>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="stats-grid compact">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo count($products); ?></h3>
                            <p>Total Productos</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-info">
                            <h3>4</h3>
                            <p>Productos Destacados</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>1</h3>
                            <p>Stock Bajo</p>
                        </div>
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