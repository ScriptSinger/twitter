<template>
    <Head title="Home" />
    <div>
        <header class="bg-white shadow">
            <div
                class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between"
            >
                <!-- Логотип Twitter -->
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

                <nav class="flex space-x-4">
                    <Link
                        :href="route('dashboard')"
                        class="text-gray-900 font-semibold hover:text-gray-700 transition duration-150 ease-in-out"
                    >
                        Dashboard
                    </Link>
                </nav>
            </div>
        </header>

        <div class="max-w-2xl mx-auto p-4">
            <!-- Форма отправки твита -->
            <div class="bg-white shadow-md rounded-lg p-4 mb-6">
                <form @submit.prevent="store">
                    <div class="mb-4">
                        <select
                            v-model="selectedCategory"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        >
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.title }}
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <input
                            type="text"
                            v-model="content"
                            placeholder="Что у вас нового?"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        />
                    </div>

                    <div class="text-right">
                        <button
                            type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none"
                        >
                            Отправить
                        </button>
                    </div>
                </form>
            </div>

            <!-- Список твитов -->
            <ul class="space-y-4">
                <li
                    v-for="tweet in tweets"
                    :key="tweet.id"
                    class="bg-white shadow-md rounded-lg p-4"
                >
                    <div class="flex items-center mb-2">
                        <div class="font-semibold text-blue-500">
                            {{ tweet.username }}
                        </div>
                        <div class="text-sm text-gray-500 ml-2">
                            {{ new Date(tweet.created_at).toLocaleString() }}
                        </div>
                    </div>

                    <div class="text-gray-700 mb-2">
                        {{ tweet.content }}
                    </div>

                    <div class="text-sm text-gray-500">
                        Категория: <strong>{{ tweet.category.title }}</strong>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<script>
export default {
    props: {
        categories: Array, // Принимаем список категорий как пропс
        tweets: Array, // Принимаем твиты как пропс
    },

    data() {
        return {
            content: "",
            selectedCategory: "", // Для выбранной категории
        };
    },

    methods: {
        store() {
            this.$inertia.post("/tweets", {
                content: this.content,
                category_id: this.selectedCategory, // Отправляем выбранную категорию
            });
        },
    },
};
</script>
