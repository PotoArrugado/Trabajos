<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex justify-center items-center min-h-screen">

    <div class="text-center p-8">
        <h1 class="text-5xl font-bold text-gray-800 dark:text-white">Panel de Gestión</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mt-3">Selecciona una opción para comenzar</p>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto">
            
            <!-- Opción: Buscar Usuarios -->
            <a href="buscar_usuarios.php" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="text-indigo-500 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.975 5.975 0 0112 13a5.975 5.975 0 01-3 5.197M15 21a6 6 0 00-9-5.197" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Buscar Usuarios</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Consulta la lista y encuentra usuarios.</p>
            </a>
            
            <!-- Opción: Buscar Instrumentos -->
            <a href="buscar_instrumentos.php" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="text-green-500 mb-4">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Buscar Instrumentos</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Explora el catálogo de instrumentos.</p>
            </a>

            <!-- Opción: Buscar Tiendas -->
            <a href="buscar_tiendas.php" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="text-yellow-500 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Buscar Tiendas</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Encuentra tiendas y su información.</p>
            </a>
            
            <!-- Opción: Añadir Usuario (Bonus) -->
            <a href="registrar.php" class="md:col-span-2 lg:col-span-3 bg-indigo-600 text-white p-6 rounded-xl shadow-lg hover:bg-indigo-700 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <h2 class="text-xl font-bold">Añadir Nuevo Usuario</h2>
                <p class="opacity-80 mt-1">Haz clic aquí para ir al formulario de registro.</p>
            </a>
        </div>
    </div>

</body>
</html>
