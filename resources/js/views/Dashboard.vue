<template>
    <div>
        <dashboard-header :view="view" @add="view = 'add'"></dashboard-header>
        <div v-if="view === 'add'">
            <consumed-add :drinks="drinks" :consumed="modify" @cancel="cancelForm" @refresh="refresh"></consumed-add>
        </div>
        <div v-else>
            <stats :stats="stats" :drinks="drinks" class="mb-4"></stats>
            <consumed-data :consumed="consumed" @edit="editConsumed" @remove="removeConsumed"></consumed-data>
        </div>
    </div>
</template>

<script>
    import DashboardHeader from '@/views/DashboardHeader'
    import ConsumedData from '@/views/ConsumedData'
    import Stats from '@/views/Stats'
    import ConsumedAdd from '@/views/ConsumedAdd'

    export default {
        components: {
            DashboardHeader,
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
                this.modify = null
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
