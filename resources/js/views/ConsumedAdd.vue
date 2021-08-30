<template>
    <div>
        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
            <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Add Consumed
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        When you've consumed a drink you can enter it here
                    </p>
                </div>
                <div class="space-y-6 sm:space-y-5">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="drink-id" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Drink
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
<!--                            <select id="drink-id" name="drinkId" v-model="drinkId" class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">-->
<!--                                <option v-for="drink in drinks" :value="drink.id" :selected="drink.id === drinkId">{{ drink.name }}</option>-->
<!--                            </select>-->
                            <fieldset class="space-y-5">
                                <legend class="sr-only">Drinks</legend>
                                <div v-for="drink in drinks" class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="drinkId" aria-describedby="drink-id-description" v-model="drinkId" name="drinkId" :value="drink.id" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="drink-id-description" class="font-medium text-gray-700">{{ drink.name }}</label>
                                        <p id="drink-id-description" class="text-gray-500">{{ drink.description }}</p>
                                    </div>
                                </div>
                            </fieldset>
                            <p v-if="errors.drinkId" class="mt-2 text-sm text-red-600" id="email-error">{{ errors.drinkId }}</p>
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="last-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Amount
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" name="last-name" v-model="amount" id="last-name" autocomplete="family-name" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            <p v-if="errors.amount" class="mt-2 text-sm text-red-600" id="email-error">{{ errors.amount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-5">
            <div class="flex justify-end">
                <button @click="cancel" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </button>
                <button @click="save" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            drinks: {
                type: Array,
                default: () => []
            },
            consumed: {
                type: Object,
                default: () => null
            }
        },
        data () {
            return {
                errors: {
                    drinkId: null,
                    amount: null
                },
                populate: false,
                id: null,
                drinkId: null,
                amount: 1
            }
        },

        methods: {
            async save () {
                try {
                    console.log(this.id, this.drinkId, this.amount)
                    this.errors.drinkId = null
                    this.errors.amount = null
                    if (this.id) {
                        await this.$http.updateConsumed(this.id, this.drinkId, this.amount)
                    } else {
                        await this.$http.addConsumed(this.drinkId, this.amount)
                    }
                    await this.$emit('refresh')
                } catch (error) {
                    if (error.status === 422) {
                        if (error.data.errors['drinkId']) {
                            this.errors.drinkId = error.data.errors['drinkId'][0]
                        }
                        if (error.data.errors['amount']) {
                            this.errors.amount = error.data.errors['amount'][0]
                        }
                    }
                    console.log('save error', error)
                }
            },

            cancel () {
                this.drink = null
                this.amount = 1
                this.$emit('cancel')
            },

            /**
             * If no drinks have been populated then lets populate with some defaults
             *
             * @returns {Promise<void>}
             */
            async populateDrinks () {
                if (this.drinks.length === 0) {
                    const drinks = await this.$http.populateDrinks()
                    this.drinks = drinks.data
                }
            }
        },

        async mounted () {
            await this.populateDrinks()
            if (this.consumed) {
                this.id = this.consumed.id
                this.drinkId = this.consumed.drinkId
                this.amount = this.consumed.amount
            }
        }
    }
</script>
