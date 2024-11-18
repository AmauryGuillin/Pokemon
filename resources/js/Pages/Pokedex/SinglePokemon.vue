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
        <div class="w-full h-[calc(100vh-4rem)] sm:hidden">
            <PokemonCardDetailed :pokemon="pokemon" :objects="objects" />
        </div>
        <div class="hidden sm:block">Desktop view</div>
    </AuthenticatedLayout>
</template>
