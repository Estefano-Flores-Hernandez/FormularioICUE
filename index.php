<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="w-full md:w-3/5 lg:w-2/4 bg-white shadow-lg rounded-lg p-8 mx-auto">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Registro de Miembros de la Iglesia</h2>
            <form id="memberForm" action="submit.php" method="post">
                <!-- Campos del formulario -->
                <div class="mb-4">
                    <div class="grid grid-flow-row sm:grid-flow-col gap-4">
                        <div class="sm:col-span-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">Nombres:</label>
                            <input
                                class="shadow appearance-none border border-gray-300 rounded w-full text-gray-700 focus:outline-none focus:border-blue-500"
                                id="firstName" name="firstName" type="text" placeholder="Luis">
                        </div>
                        <div class="sm:col-span-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">Apellidos:</label>
                            <input
                                class="shadow appearance-none border border-gray-300 rounded w-full text-gray-700 focus:outline-none focus:border-blue-500"
                                id="lastName" name="lastName" type="text" placeholder="Aguilar">
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="grid grid-flow-row sm:grid-flow-col gap-4">
                        <div class="sm:col-span-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Teléfono:</label>
                            <input
                                class="shadow appearance-none border border-gray-300 rounded w-full text-gray-700 focus:outline-none focus:border-blue-500"
                                id="phone" name="phone" type="tel" placeholder="XXXXXXXXX">
                        </div>
                        <div class="sm:col-span-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">Fecha de Nacimiento:</label>
                            <input
                                class="shadow appearance-none border border-gray-300 rounded w-full focus:outline-none focus:border-blue-500"
                                id="dob" name="dob" type="date">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Género:</label>
                    <div class="flex items-center">
                        <label class="mr-4">
                            <input type="radio" name="gender" value="male">
                            <span>Hombre</span>
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female">
                            <span>Mujer</span>
                        </label>
                    </div>
                </div>

                <!-- Botón de envío -->
                <div class="flex items-center justify-center">
                    <button type="submit" class="button">
                        <span class="button-content">Enviar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="validations.js"></script>
</body>

</html>