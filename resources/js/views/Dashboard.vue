<template>
    <div>
        <div v-if="view === 'add'">
            <consumed-add :drinks="drinks" :consumed="modify" @cancel="cancelForm" @refresh="refresh"></consumed-add>
        </div>
        <div v-else>
            <div class="p-2">
                <h3 class="mb-4">Drinks Consumed</h3>
                <button @click="view = 'add'" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add
                </button>
            </div>
            <consumed-data :consumed="consumed" @edit="editConsumed" @remove="removeConsumed"></consumed-data>
            <stats :stats="stats"></stats>
        </div>
    </div>
</template>

<script>
    import ConsumedData from '@/views/ConsumedData'
    import Stats from '@/views/Stats'
    import ConsumedAdd from '@/views/ConsumedAdd'

    export default {
        components: {
            ConsumedData,
            Stats,
            ConsumedAdd
        },

        data () {
            return {
                view: 'table',
                drinks: [],
                consumed: null,
                modify: null,
                stats: null
            }
        },

        methods: {
            async loadConsumed () {
                try {
                    const consumed = await this.$http.getConsumed()
                    this.consumed = consumed.data
                    await this.loadStats()
                } catch (error) {
                    console.log('loadConsumed error', error)
                }
            },

            async loadStats () {
                try {
                    const stats = await this.$http.getConsumedStats()
                    console.log('stats', stats)
                    this.stats = stats.data
                } catch (error) {
                    console.log('loadStats error', error)
                }
            },

            async loadDrinks () {
                const drinks = await this.$http.getDrinks()
                this.drinks = drinks.data
            },

            cancelForm () {
                this.view = 'table'
            },

            editConsumed (consumed) {
                this.view = 'add'
                this.modify = consumed
            },

            async removeConsumed (consumed) {
                await this.$http.removeConsumed(consumed.id)
                await this.refresh()
            },

            async refresh () {
                await this.loadConsumed()
                this.view = 'table'
                this.modify = null
            }
        },

        async mounted () {
            await this.loadConsumed()
            await this.loadDrinks()
        }
    }
</script>
