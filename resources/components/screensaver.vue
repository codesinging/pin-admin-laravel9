<template>
    <div v-if="screensaver.visible" class="h-screen flex flex-col items-center justify-center">
        <div class="h-16">
            <img src="../images/logo.svg" alt="Logo" class="h-16 h-16 animate-pulse">
        </div>
        <div v-if="slots.default" class="mt-2">
            <slot>{{ screensaver.text }}</slot>
        </div>
    </div>
</template>

<script setup>
import {useSlots} from "vue";
import {useScreensaver} from "../store/screensaver";

const slots = useSlots()
const screensaver = useScreensaver()
</script>

<style scoped>

</style>
