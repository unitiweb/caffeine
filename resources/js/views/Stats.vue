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
        <div class="mt-4">
            <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">You can still drink</h2>
            <ul v-if="allowed.length >= 1" role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <li v-for="drink in allowed" class="col-span-1 flex shadow-sm rounded-md">
                    <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-l-md truncate">
                        <div class="flex-1 px-4 py-2 text-sm truncate">
                            <div class="text-gray-900 font-medium hover:text-gray-600">{{ drink.name }}</div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 flex items-center justify-center w-16 bg-blue-600 text-white text-sm font-medium rounded-r-md">
                        {{ drink.caffeine }}mg
                    </div>
                </li>
            </ul>
            <ul v-else role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <li class="col-span-1 flex shadow-sm rounded-md">
                    <div class="flex-1 flex items-center justify-between border border-pink-300 bg-pink-100 rounded-md truncate">
                        <div class="flex-1 px-4 py-2 text-sm truncate">
                            <div class="text-gray-900 font-medium hover:text-gray-600">You've had enough!</div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            stats: {
                type: Object,
                default: null
            },
            drinks: {
                type: Array,
                default: () => []
            }
        },

        computed: {
            allowed () {
                if (this.stats) {
                    const allowed = []
                    this.drinks.forEach((d) => {
                        if (d.caffeine <= this.stats.left) {
                            allowed.push(d)
                        }
                    })
                    return allowed
                }
                return []
            }
        }
    }
</script>
