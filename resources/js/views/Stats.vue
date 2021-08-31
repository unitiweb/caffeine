<template>
    <div>
        <dl v-if="stats" class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">
                    Caffeine Allowed
                </dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ stats.max }}mg
                </dd>
            </div>
            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">
                    Amount Consumed
                </dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ stats.total }}mg
                </dd>
            </div>
            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">
                    Still Can Consume
                </dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ stats.left }}mg
                </dd>
            </div>
        </dl>
    </div>
</template>

<script>
    export default {
        props: {
            stats: {
                type: Object,
                default: null
            }
        }
    }
</script>
