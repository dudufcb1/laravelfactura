<div class="bg-gradient-to-br from-gray-50 to-gray-100 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Preguntas Frecuentes</h2>
            <p class="text-lg text-gray-600">Todo lo que necesitas saber sobre este proyecto</p>
        </div>

        <!-- FAQ Items -->
        <div class="space-y-4" x-data="{ openFaq: null }">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <button
                    @click="openFaq = openFaq === 1 ? null : 1"
                    class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">¿Qué es este proyecto?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transform transition-transform"
                        :class="{ 'rotate-180': openFaq === 1 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 1"
                    x-collapse
                    class="px-6 pb-4 text-gray-700">
                    <p class="leading-relaxed">
                        Este es un <span class="font-semibold">sistema completo de facturación</span> construido con Laravel 11, diseñado como demo técnico para mostrar capacidades en desarrollo full-stack. Incluye gestión de clientes, productos, facturas, pagos y reportes.
                    </p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <button
                    @click="openFaq = openFaq === 2 ? null : 2"
                    class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">¿Cuáles son las principales funcionalidades?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transform transition-transform"
                        :class="{ 'rotate-180': openFaq === 2 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 2"
                    x-collapse
                    class="px-6 pb-4 text-gray-700">
                    <ul class="space-y-2 list-disc list-inside">
                        <li><span class="font-medium">Gestión de Clientes:</span> CRUD completo con validaciones</li>
                        <li><span class="font-medium">Catálogo de Productos:</span> Administración de inventario y precios</li>
                        <li><span class="font-medium">Facturación:</span> Creación de facturas con cálculos automáticos</li>
                        <li><span class="font-medium">Sistema de Pagos:</span> Registro y seguimiento de pagos</li>
                        <li><span class="font-medium">Reportes PDF:</span> Generación de documentos profesionales</li>
                        <li><span class="font-medium">Multi-empresa:</span> Soporte para múltiples compañías</li>
                        <li><span class="font-medium">Autenticación:</span> Sistema completo de usuarios y permisos</li>
                    </ul>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <button
                    @click="openFaq = openFaq === 3 ? null : 3"
                    class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">¿Qué tecnologías utiliza?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transform transition-transform"
                        :class="{ 'rotate-180': openFaq === 3 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 3"
                    x-collapse
                    class="px-6 pb-4 text-gray-700">
                    <div class="space-y-3">
                        <p><span class="font-semibold">Backend:</span> Laravel 11, PHP 8.2, MySQL, Eloquent ORM</p>
                        <p><span class="font-semibold">Frontend:</span> Blade Templates, Tailwind CSS, Alpine.js, Livewire</p>
                        <p><span class="font-semibold">Herramientas:</span> Vite, Composer, NPM, Git</p>
                        <p class="text-sm text-gray-600 italic mt-3">
                            Stack moderno siguiendo las mejores prácticas del ecosistema Laravel.
                        </p>
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <button
                    @click="openFaq = openFaq === 4 ? null : 4"
                    class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">¿Cómo puedo probar la aplicación?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transform transition-transform"
                        :class="{ 'rotate-180': openFaq === 4 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 4"
                    x-collapse
                    class="px-6 pb-4 text-gray-700">
                    <p class="mb-3">Puedes usar las siguientes credenciales demo:</p>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 space-y-3">
                        <div>
                            <p class="font-semibold text-blue-900">Administrador</p>
                            <p class="text-sm font-mono text-gray-700">admin@laravelfactura.com / admin123</p>
                        </div>
                        <div>
                            <p class="font-semibold text-blue-900">Contador</p>
                            <p class="text-sm font-mono text-gray-700">contador@laravelfactura.com / contador123</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <button
                    @click="openFaq = openFaq === 5 ? null : 5"
                    class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">¿Es un proyecto de código abierto?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transform transition-transform"
                        :class="{ 'rotate-180': openFaq === 5 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 5"
                    x-collapse
                    class="px-6 pb-4 text-gray-700">
                    <p class="leading-relaxed">
                        Sí, este proyecto es <span class="font-semibold">demo técnico</span> desarrollado por Eduardo Martínez para mostrar habilidades en desarrollo web. El código está disponible en GitHub para referencia y aprendizaje.
                    </p>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <button
                    @click="openFaq = openFaq === 6 ? null : 6"
                    class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">¿Quién desarrolló este proyecto?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transform transition-transform"
                        :class="{ 'rotate-180': openFaq === 6 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 6"
                    x-collapse
                    class="px-6 pb-4 text-gray-700">
                    <p class="leading-relaxed mb-3">
                        Desarrollado por <span class="font-semibold">Eduardo Martínez</span>, desarrollador full-stack especializado en Laravel y tecnologías web modernas.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <a href="https://www.linkedin.com/in/dudufcb/" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                            LinkedIn
                        </a>
                        <a href="https://github.com/dudufcb1" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-gray-700 text-white rounded-lg text-sm hover:bg-gray-800 transition">
                            GitHub
                        </a>
                        <a href="https://devactivo.com/" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition">
                            Portafolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
