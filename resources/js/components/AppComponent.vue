<template>
    <div >
        <notifications position="top right" />


        <component :is="this.$route.meta.layout || 'div'">
            <router-view />
        </component>
    </div>
</template>

<script>
    export default {

    }
</script>
