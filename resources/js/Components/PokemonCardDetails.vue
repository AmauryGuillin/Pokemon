<script lang="ts" setup>
import AttacksDialog from "@/Components/AttacksDialog.vue";
import { Weight, Ruler, Swords } from "lucide-vue-next";

const props = defineProps<{
    pokemon: any;
    objects: any;
}>();
</script>

<template>
    <div class="text-center font-bold text-3xl p-5">Details</div>
    <div class="grid grid-cols-3 items-center justify-center text-center">
        <div
            class="flex flex-col justify-center items-center border-r-2 border-gray-300 h-full space-y-5"
        >
            <div class="flex justify-center items-center gap-2">
                <Weight />
                Masse
            </div>
            <div class="font-bold text-2xl">{{ pokemon.weight }} kg</div>
        </div>
        <div
            class="flex flex-col justify-center items-center border-r-2 border-gray-300 h-full space-y-5"
        >
            <div class="flex justify-center items-center gap-2">
                <Ruler />
                Taille
            </div>
            <div class="font-bold text-2xl">{{ pokemon.height }} m</div>
        </div>
        <div class="grid justify-center items-center h-full gap-2">
            <div class="flex justify-center items-center gap-2">
                <Swords />
                Attaques
            </div>
            <div class="flex justify-center items-center gap-4">
                <div
                    class="flex flex-col justify-center items-start text-sm 2xl:text-md"
                >
                    <span v-for="attack in objects.attackNames">
                        {{ attack }}
                    </span>
                </div>
                <div>
                    <AttacksDialog :objects="objects" :pokemon="pokemon" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
