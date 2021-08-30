<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <slot />
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Drink
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="cons in consumed" class="bg-white">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ cons.drink.name }}
                                <div class="text-sm font-thin">{{ cons.drink.description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{ cons.amount }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="edit(cons)" class="ml-3 inline-flex justify-center py-1 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    edit
                                </button>
                                <button @click="remove(cons)" class="ml-3 inline-flex justify-center py-1 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    delete
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                consumed: []
            }
        },

        methods: {
            async loadConsumed () {
                try {
                    const consumed = await this.$http.getConsumed()
                    this.consumed = consumed.data
                } catch (error) {
                    console.log('loadConsumed error', error)
                }
            },

            edit (consumed) {
                this.$emit('edit', consumed)
            },

            async remove (consumed) {
                await this.$http.removeConsumed(consumed.id)
                await this.loadConsumed()
            }
        },

        async mounted () {
            await this.loadConsumed()
            console.log('this.consumed', this.consumed)
        }
    }
</script>
