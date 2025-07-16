<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @filamentStyles
</head>

<body class="h-full font-sans antialiased" style="background-color: var(--background);">
    <div class="min-h-full">
        <!-- Header -->
        <header class="shadow-sm"
            style="background-color: var(--background); border-bottom: 1px solid var(--secondary-01);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold" style="color: var(--primary);">
                            {{ config('app.name', 'Laravel') }}
                        </h1>
                    </div>

                    @auth
                        <div class="flex items-center space-x-4">
                            <span class="text-sm" style="color: var(--secondary-04);">
                                Hola, {{ Auth::user()->name }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-sm px-4 py-2 rounded-md transition-colors duration-200 hover:bg-opacity-80"
                                    style="background-color: var(--primary); color: white;">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-4">
                            <a href="{{ url('/login') }}"
                                class="text-sm px-4 py-2 rounded-md transition-colors duration-200 hover:bg-opacity-80"
                                style="background-color: var(--primary); color: white;">
                                Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ url('/register') }}"
                                    class="text-sm px-4 py-2 rounded-md border transition-colors duration-200 hover:bg-opacity-10"
                                    style="color: var(--primary); border-color: var(--primary); background-color: transparent;">
                                    Registrarse
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4" style="color: var(--primary-off);">
                    Bienvenido a tu Aplicación
                </h2>
                <p class="text-xl max-w-2xl mx-auto" style="color: var(--secondary-04);">
                    Una plataforma moderna construida con Laravel, Livewire, Filament y Tailwind CSS para brindarte la
                    mejor experiencia.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div class="p-6 rounded-lg shadow-sm border"
                    style="background-color: var(--secondary-01); border-color: var(--secondary-02);">
                    <div class="w-12 h-12 rounded-lg mb-4 flex items-center justify-center"
                        style="background-color: var(--primary);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2" style="color: var(--primary-off);">
                        Rendimiento Rápido
                    </h3>
                    <p class="text-sm" style="color: var(--secondary-04);">
                        Optimizado para velocidad y eficiencia con las últimas tecnologías web.
                    </p>
                </div>

                <div class="p-6 rounded-lg shadow-sm border"
                    style="background-color: var(--secondary-01); border-color: var(--secondary-02);">
                    <div class="w-12 h-12 rounded-lg mb-4 flex items-center justify-center"
                        style="background-color: var(--primary);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2" style="color: var(--primary-off);">
                        Confiable y Seguro
                    </h3>
                    <p class="text-sm" style="color: var(--secondary-04);">
                        Construido con las mejores prácticas de seguridad y estabilidad.
                    </p>
                </div>

                <div class="p-6 rounded-lg shadow-sm border"
                    style="background-color: var(--secondary-01); border-color: var(--secondary-02);">
                    <div class="w-12 h-12 rounded-lg mb-4 flex items-center justify-center"
                        style="background-color: var(--primary);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2" style="color: var(--primary-off);">
                        Fácil de Usar
                    </h3>
                    <p class="text-sm" style="color: var(--secondary-04);">
                        Interfaz intuitiva diseñada pensando en la experiencia del usuario.
                    </p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center p-8 rounded-lg" style="background-color: var(--secondary-01);">
                <h3 class="text-2xl font-bold mb-4" style="color: var(--primary-off);">
                    ¿Listo para comenzar?
                </h3>
                <p class="text-lg mb-6" style="color: var(--secondary-04);">
                    Explora todas las funcionalidades que tenemos para ti.
                </p>
                @auth
                    <a href="{{ url('/register') }}"
                        class="inline-block px-8 py-3 text-lg font-medium rounded-md transition-colors duration-200 hover:bg-opacity-90"
                        style="background-color: var(--primary); color: white;">
                        Comenzar Ahora
                    </a>
                @else
                    <a href="{{ url('/admin') }}"
                        class="inline-block px-8 py-3 text-lg font-medium rounded-md transition-colors duration-200 hover:bg-opacity-90"
                        style="background-color: var(--primary); color: white;">
                        Ir al Panel de Control
                    </a>                    
                @endauth
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-16 py-8 border-t"
            style="background-color: var(--secondary-01); border-color: var(--secondary-02);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-sm" style="color: var(--secondary-04);">
                        © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    @filamentScripts
</body>

</html>
