<template>
    <h3 class="p-4 text-center">You are being logged out</h3>
</template>

<script>
    export default {
        async mounted () {
            await this.$store.dispatch('logout')
            location.href = this.$router.resolve({ name: 'login' }).href
        }
    }
</script>
