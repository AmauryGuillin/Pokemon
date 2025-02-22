<script setup lang="ts">
import PokemonCardDetailedD from "@/Components/PokemonCardDetailedD.vue";
import PokemonCardDetailedM from "@/Components/PokemonCardDetailedM.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps<{
    pokemon: any;
    objects: any;
}>();
</script>

<template>
    <Head :title="'Pokedex - ' + pokemon.name" />
    <AuthenticatedLayout>
        <div class="w-full h-[calc(100vh-4rem)] sm:hidden">
            <PokemonCardDetailedM :pokemon="pokemon" :objects="objects" />
        </div>
        <div
            class="hidden sm:flex justify-center items-center bg-[#DC0A2D] h-[calc(100vh-4rem)]"
        >
            <PokemonCardDetailedD :pokemon="pokemon" :objects="objects" />
        </div>
    </AuthenticatedLayout>
</template>
