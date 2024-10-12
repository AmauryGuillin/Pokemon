<script setup lang="ts">
import PokemonCardSimple from "@/Components/PokemonCardSimple.vue";
import { Input } from "@/Components/ui/input";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Search } from "lucide-vue-next";
import { ref } from "vue";

const props = defineProps<{
    //pokemons: any;
}>();

// const searchWord = ref("");
// function searchPokemon(input: string) {
//     searchWord.value = input.toLowerCase().trim();
// }
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
