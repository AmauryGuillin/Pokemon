<script setup lang="ts">
import PokemonCardSimple from "@/Components/PokemonCardSimple.vue";
import { Badge } from "@/Components/ui/badge";
import { Input } from "@/Components/ui/input";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Search } from "lucide-vue-next";
import { ref } from "vue";
import {createLogger} from "vite";

const props = defineProps<{
    pokemons: any;
    types: any;
}>();

const pokemonArray = ref(props.pokemons);

const searchWord = ref("");
const searchType = ref<null | string>("");
function searchPokemon(input: string) {
    searchWord.value = input.toLowerCase().trim();
    pokemonArray.value = props.pokemons.filter((p: any) => p.name.toLowerCase().trim().startsWith(searchWord.value));
}

function searchByType(input: string) {
    if(!input) return;
    searchType.value = input === searchType.value ? null : input;
    if (!searchType.value) {
        pokemonArray.value = props.pokemons
        return;
    }
    pokemonArray.value = props.pokemons.filter((p: any) => p.type_prime.name.toLowerCase().trim() === searchType.value.toLowerCase().trim()
        || p.type_second?.name.toLowerCase().trim() === searchType.value.toLowerCase().trim())
}
</script>

<template>
    <Head title="Pokedex" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="flex justify-center items-center mb-5 flex-col">
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
                <div
                    class="pt-4 flex justify-center items-center gap-2 flex-wrap"
                >
                    <div v-for="type in types">
                        <Badge
                            class="cursor-pointer hover:scale-[1.05] transition-all"
                            :class="{'border-2 border-red-500' : searchType === type.name }"
                            :style="{ backgroundColor: searchType === type.name ? 'gray' : type.color.value }"
                            @click="searchByType(type.name)"
                            >{{ type.name }}</Badge
                        >
                    </div>
                </div>
            </div>
            <div
                v-if="pokemonArray.length !== 0"
                class="grid justify-center grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mx-2 lg:mx-48"
            >
                <PokemonCardSimple
                    v-for="pokemon in pokemonArray"
                    :key="pokemon.name"
                    :pokemon="pokemon"
                />
            </div>
            <div v-else class="text-center font-bold p-48">
                <span>Aucun Pokémon trouvé.</span>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
