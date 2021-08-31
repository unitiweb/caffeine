<template>
    <div class="min-h-screen bg-white">
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                            <button class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" aria-current="page">
                                Dashboard
                            </button>
                            <button @click="logout" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium" aria-current="page">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="py-10">
            <main>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="sm:px-0">
                        <div>
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            logout () {
                this.$router.push({ name: 'logout' })
            }
        }
    }
</script>
