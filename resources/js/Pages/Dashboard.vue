<script setup lang="ts">
import PokemonCardSimple from "@/Components/PokemonCardSimple.vue";
import { Input } from "@/Components/ui/input";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Search } from "lucide-vue-next";
import { ref } from "vue";

const props = defineProps<{
    pokemons: any;
}>();

const searchWord = ref("");
function searchPokemon(input: string) {
    searchWord.value = input.toLowerCase().trim();
}
</script>

<template>
    <Head title="Pokedex" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="flex justify-center items-center mb-5">
                <div class="relative w-full max-w-sm items-center">
                    <Input
                        id="search"
                        type="text"
                        placeholder="Rechercher..."
                        class="pl-10"
                        @input="(event: any) => searchPokemon(event.target.value)"
                    />
                    <span
                        class="absolute start-0 inset-y-0 flex items-center justify-center px-2"
                    >
                        <Search class="size-6 text-muted-foreground" />
                    </span>
                </div>
            </div>
            <div
                class="grid justify-center grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mx-2 lg:mx-48"
            >
                <PokemonCardSimple
                    v-for="pokemon in pokemons.filter((p :any) => p.name.toLowerCase().trim().includes(searchWord))"
                    :key="pokemon.name"
                    :pokemon="pokemon"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
