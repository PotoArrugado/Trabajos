<?php
// Lógica de búsqueda de tiendas
$servidor = "localhost"; $usuario = "root"; $clave = ""; $baseDeDatos = "form";
$enlace = @mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) { die("Error de conexión."); }

$results_grouped = [];
$search_query = '';
$sql = "SELECT id, nombre, ubicacion, telefono, sitio_web FROM tiendas ORDER BY nombre ASC"; // Consulta por defecto

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = trim($_GET['search']);
    $safe_query = mysqli_real_escape_string($enlace, $search_query);
    $sql = "SELECT id, nombre, ubicacion, telefono, sitio_web FROM tiendas WHERE nombre LIKE '%$safe_query%' OR ubicacion LIKE '%$safe_query%' ORDER BY nombre ASC";
}

$result = mysqli_query($enlace, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Agrupar por letra inicial
        $inicial = strtoupper(substr($row['nombre'], 0, 1));
        if (!isset($results_grouped[$inicial])) {
            $results_grouped[$inicial] = [];
        }
        $results_grouped[$inicial][] = $row;
    }
}
mysqli_close($enlace);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Tiendas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="container mx-auto p-4 md:p-8">
        <header class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white">Búsqueda de Tiendas</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">Encuentra tiendas de música y su información.</p>
            <a href="index.php" class="mt-4 inline-flex items-center gap-2 text-yellow-600 hover:text-yellow-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                Volver al Menú Principal
            </a>
        </header>

        <div class="w-full bg-white rounded-xl shadow-lg dark:bg-gray-800 p-6 md:p-8">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="mb-8 flex flex-col sm:flex-row gap-4">
                <input type="text" name="search" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Buscar por nombre o ubicación..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-md hover:bg-yellow-700">Buscar</button>
            </form>

            <?php if (count($results_grouped) > 0): ?>
                <?php foreach ($results_grouped as $inicial => $tiendas): ?>
                    <div class="mb-8">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 dark:bg-gray-700 text-xl font-bold text-gray-600 dark:text-gray-300"><?php echo $inicial; ?></span>
                            <div class="w-full h-px bg-gray-300 dark:bg-gray-600"></div>
                        </div>
                        <div class="space-y-4">
                            <?php foreach ($tiendas as $tienda): ?>
                                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg flex flex-col sm:flex-row justify-between sm:items-center">
                                    <div>
                                        <h3 class="font-bold text-lg text-yellow-700 dark:text-yellow-400"><?php echo htmlspecialchars($tienda['nombre']); ?></h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1"><?php echo htmlspecialchars($tienda['ubicacion']); ?></p>
                                    </div>
                                    <div class="mt-3 sm:mt-0 text-left sm:text-right flex-shrink-0">
                                        <p class="text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($tienda['telefono']); ?></p>
                                        <?php if (!empty($tienda['sitio_web'])): ?>
                                            <a href="<?php echo htmlspecialchars($tienda['sitio_web']); ?>" target="_blank" rel="noopener noreferrer" class="text-sm text-indigo-500 hover:underline">Visitar sitio web</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-10">
                    <p class="text-gray-500">No se encontraron tiendas que coincidan con la búsqueda.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
