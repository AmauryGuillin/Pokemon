<script setup lang="ts">
import PokemonCardDetailed from "@/Components/PokemonCardDetailed.vue";
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
        <div class="flex justify-center w-full h-screen p-10">
            <PokemonCardDetailed :pokemon="pokemon" :objects="objects" />
        </div>
    </AuthenticatedLayout>
</template>
