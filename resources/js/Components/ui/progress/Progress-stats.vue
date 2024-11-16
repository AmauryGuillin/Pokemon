<script setup lang="ts">
import { cn } from "@/lib/utils";
import {
    ProgressIndicator,
    ProgressRoot,
    type ProgressRootProps,
} from "radix-vue";
import { type HTMLAttributes, computed } from "vue";

const props = withDefaults(
    defineProps<
        ProgressRootProps & {
            class?: HTMLAttributes["class"];
            color?: string;
        }
    >(),
    {
        modelValue: 0,
    },
);

const delegatedProps = computed(() => {
    const { class: _, ...delegated } = props;

    return delegated;
});
</script>

<template>
    <ProgressRoot
        v-bind="delegatedProps"
        :class="
            cn(
                'relative h-2 w-full overflow-hidden rounded-full bg-gray-300',
                props.class,
            )
        "
    >
        <ProgressIndicator
            class="h-full w-full flex-1 bg-primary transition-all"
            :style="`transform: translateX(-${
                100 - ((props.modelValue || 0) / 250) * 100
            }%); backgroundColor: ${color}`"
        />
    </ProgressRoot>
</template>
