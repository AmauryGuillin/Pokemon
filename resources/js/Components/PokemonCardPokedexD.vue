<script setup lang="ts">
import PokeBallSvg from "@/Components/PokeBallSvg.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps<{
    pokemon: any;
}>();
</script>

<template>
    <div
        id="card"
        class="border-2 rounded-2xl shadow-lg cursor-pointer hover:scale-[1.03] transition-all"
    >
        <Link :href="`pokedex/${pokemon.name}`">
            <div
                id="number"
                class="flex justify-between items-center px-4 py-2 font-semibold text-lg text-white rounded-t-xl"
                :style="{
                    backgroundColor: pokemon.type_prime.color.value,
                }"
            >
                <PokeBallSvg />
                N°{{ String(pokemon.number).padStart(3, "0") }}
            </div>
            <div id="image" class="flex justify-center items-center">
                <img :src="pokemon.image_artwork" alt="" class="size-2/4" />
            </div>
            <div
                id="name"
                class="flex justify-center items-center text-2xl font-bold mb-3"
            >
                {{ pokemon.name }}
            </div>
        </Link>
    </div>
</template>
