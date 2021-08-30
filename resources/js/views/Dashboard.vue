<template>
    <div>
        <div v-if="view === 'add'">
            <consumed-add :consumed="consumed" @cancel="cancelForm"></consumed-add>
        </div>
        <div v-else>
            <div class="p-2">
                <h3 class="mb-4">Drinks Consumed</h3>
                <button @click="view = 'add'" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add
                </button>
            </div>
            <consumed-data @edit="editConsumed"></consumed-data>
        </div>
    </div>
</template>

<script>
import ConsumedData from '@/views/ConsumedData'
import ConsumedAdd from '@/views/ConsumedAdd'

    export default {
        components: {
            ConsumedData,
            ConsumedAdd
        },

        data () {
            return {
                view: 'table',
                consumed: null
            }
        },

        methods: {
            cancelForm () {
                this.view = 'table'
            },

            editConsumed (consumed) {
                this.view = 'add'
                this.consumed = consumed
            }
        }
    }
</script>
