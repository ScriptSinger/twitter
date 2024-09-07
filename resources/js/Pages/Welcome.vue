<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
    <div
        class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex flex-col items-center justify-center"
    >
        <!-- Заголовок -->
        <div class="mb-8 flex items-center justify-center">
            <div class="flex items-center">
                <svg
                    class="h-12 w-12 text-blue-500"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <path
                        d="M23.953 4.569a10 10 0 01-2.825.775 4.932 4.932 0 002.163-2.723 9.864 9.864 0 01-3.127 1.195 4.917 4.917 0 00-8.38 4.482A13.94 13.94 0 011.64 3.161 4.916 4.916 0 003.194 9.86a4.902 4.902 0 01-2.229-.616v.061a4.918 4.918 0 003.946 4.827 4.905 4.905 0 01-2.224.084 4.923 4.923 0 004.597 3.417A9.867 9.867 0 010 19.54a13.934 13.934 0 007.548 2.212c9.142 0 14.307-7.721 13.995-14.646a9.935 9.935 0 002.46-2.537z"
                    />
                </svg>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="text-center">
            <h1 class="text-3xl font-bold mb-4">В курсе происходящего</h1>
            <p class="text-lg mb-6">Присоединяйтесь сегодня.</p>
            <nav class="space-x-4">
                <template v-if="canLogin">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="text-blue-500 hover:text-blue-600 dark:hover:text-blue-400"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-blue-500 hover:text-blue-600 dark:hover:text-blue-400"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="text-blue-500 hover:text-blue-600 dark:hover:text-blue-400"
                        >
                            Register
                        </Link>
                    </template>
                </template>
            </nav>
        </main>

        <!-- Подвал -->
        <footer class="mt-8 text-sm">
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </footer>
    </div>
</template>
