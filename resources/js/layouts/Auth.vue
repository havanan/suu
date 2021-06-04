<template>
    <div class="h-100">
        <div class="authincation h-100">
            <div class="container h-100">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Auth"
}
</script>
<style lang="scss">
.h-100 {
    margin-top: 100px;
}
</style>
