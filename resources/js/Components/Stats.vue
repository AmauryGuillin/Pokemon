<script setup lang="ts">
import ProgressStats from "./ui/progress/Progress-stats.vue";

defineProps<{
    value: number;
    color: any;
}>();
</script>

<template>
    <div class="grid grid-cols-[15%_5%_70%] ml-10 items-center">
        <span><slot /></span>
        <span>{{ value }}</span>
        <ProgressStats :color="color" :model-value="value"></ProgressStats>
    </div>
</template>
