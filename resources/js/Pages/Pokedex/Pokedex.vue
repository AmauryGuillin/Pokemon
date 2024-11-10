<script setup lang="ts">
import PokemonCardPokedexD from "@/Components/PokemonCardPokedexD.vue";
import PokemonCardPokedexM from "@/Components/PokemonCardPokedexM.vue";
import { Badge } from "@/Components/ui/badge";
import { Button } from "@/Components/ui/button";
import {
    Drawer,
    DrawerContent,
    DrawerDescription,
    DrawerTitle,
    DrawerTrigger,
} from "@/Components/ui/drawer";
import { Input } from "@/Components/ui/input";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Filter, FilterX, Search } from "lucide-vue-next";
import { ref } from "vue";

const props = defineProps<{
    pokemons: any;
    types: any;
}>();

const usablePokemonList = ref(props.pokemons);
const searchWord = ref("");
const searchType = ref<null | string>();

function searchByName(input: string) {
    searchWord.value = input;
    usablePokemonList.value = props.pokemons.filter((p: any) =>
        p.name.toLowerCase().trim().startsWith(searchWord.value),
    );
}

function searchByType(input: string) {
    searchWord.value = "";
    if (!input) return;
    searchType.value = input === searchType.value ? null : input;
    if (!searchType.value) {
        usablePokemonList.value = props.pokemons;
        return;
    }
    usablePokemonList.value = props.pokemons.filter(
        (p: any) =>
            p.type_prime.name.toLowerCase().trim() ===
                searchType.value?.toLowerCase().trim() ||
            p.type_second?.name.toLowerCase().trim() ===
                searchType.value?.toLowerCase().trim(),
    );
}

function removeFilters() {
    searchType.value = "";
    searchWord.value = "";
    usablePokemonList.value = props.pokemons;
}
</script>

<template>
    <Head title="Pokedex" />

    <AuthenticatedLayout>
        <main class="bg-[#DC0A2D] flex flex-col h-[calc(100vh-4rem)]">
            <header class="grid items-center gap-2 py-3 px-3">
                <section class="flex items-center gap-3">
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M14.8572 12C14.8572 13.578 13.578 14.8571 12.0001 14.8571C10.4221 14.8571 9.14292 13.578 9.14292 12C9.14292 10.422 10.4221 9.14286 12.0001 9.14286C13.578 9.14286 14.8572 10.422 14.8572 12Z"
                            fill="white"
                        />
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.0001 24C18.0454 24 23.0467 19.5296 23.8785 13.7143H16.8503C16.1443 15.7118 14.2393 17.1429 12.0001 17.1429C9.76083 17.1429 7.85584 15.7118 7.14984 13.7143H0.121582C0.953404 19.5296 5.95468 24 12.0001 24ZM7.14984 10.2857H0.121582C0.953404 4.47035 5.95468 0 12.0001 0C18.0454 0 23.0467 4.47035 23.8785 10.2857H16.8503C16.1443 8.28824 14.2393 6.85714 12.0001 6.85714C9.76083 6.85714 7.85584 8.28824 7.14984 10.2857ZM14.8572 12C14.8572 13.578 13.578 14.8571 12.0001 14.8571C10.4221 14.8571 9.14292 13.578 9.14292 12C9.14292 10.422 10.4221 9.14286 12.0001 9.14286C13.578 9.14286 14.8572 10.422 14.8572 12Z"
                            fill="white"
                        />
                    </svg>
                    <h1 class="text-white font-bold text-2xl">Pokédex</h1>
                </section>
                <section class="flex justify-center items-center gap-2 px-4">
                    <div class="relative w-full sm:w-1/4 items-center">
                        <Input
                            id="search"
                            type="text"
                            placeholder="Rechercher..."
                            class="pl-10"
                            v-model="searchWord"
                            @input="
                                (event: any) =>
                                    searchByName(
                                        event.target.value.trim().toLowerCase(),
                                    )
                            "
                        />
                        <span
                            class="absolute start-0 inset-y-0 flex items-center justify-center px-2"
                        >
                            <Search class="size-6 text-muted-foreground" />
                        </span>
                    </div>
                    <div>
                        <Drawer>
                            <DrawerTrigger>
                                <Button variant="outline" size="icon">
                                    <Filter />
                                </Button>
                            </DrawerTrigger>
                            <DrawerContent>
                                <DrawerTitle
                                    class="flex justify-center items-center p-3"
                                    >Tri par type</DrawerTitle
                                >
                                <DrawerDescription
                                    class="flex justify-center items-center flex-wrap gap-3 p-5"
                                >
                                    <Badge
                                        v-for="type in types"
                                        class="cursor-pointer hover:scale-[1.05] transition-all"
                                        :class="{
                                            'border-2 border-red-500':
                                                searchType === type.name,
                                        }"
                                        :style="{
                                            backgroundColor:
                                                searchType === type.name
                                                    ? 'gray'
                                                    : type.color.value,
                                        }"
                                        @click="searchByType(type.name)"
                                        >{{ type.name }}</Badge
                                    >
                                </DrawerDescription>
                            </DrawerContent>
                        </Drawer>
                    </div>
                    <div>
                        <Button
                            variant="outline"
                            size="icon"
                            @click="removeFilters()"
                        >
                            <FilterX />
                        </Button>
                    </div>
                </section>
            </header>
            <!-------------------->
            <!-- Mobile View -->
            <!-------------------->
            <section
                class="bg-white rounded-xl mx-2 my-3 p-3 flex-1 space-y-3 shadow-inner overflow-y-auto sm:hidden"
            >
                <div
                    v-if="usablePokemonList.length === 0"
                    class="flex justify-center items-center"
                >
                    <p class="font-bold p-5">Aucun Pokémon n'a été trouvé !</p>
                </div>
                <div v-for="pokemon in usablePokemonList">
                    <PokemonCardPokedexM
                        :pokemon="pokemon"
                    ></PokemonCardPokedexM>
                </div>
            </section>
            <!-------------------->
            <!-- Desktop View -->
            <!-------------------->
            <section
                class="hidden sm:flex bg-white rounded-xl mx-4 my-3 p-3 flex-1 space-y-3 shadow-inner overflow-y-auto"
            >
                <div
                    v-if="usablePokemonList.length === 0"
                    class="w-full text-center"
                >
                    <p class="font-bold p-5">Aucun Pokémon n'a été trouvé !</p>
                </div>
                <div
                    v-if="usablePokemonList.length > 0"
                    class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 w-full h-fit gap-3"
                >
                    <div v-for="pokemon in usablePokemonList">
                        <PokemonCardPokedexD
                            :pokemon="pokemon"
                        ></PokemonCardPokedexD>
                    </div>
                </div>
            </section>
        </main>
    </AuthenticatedLayout>
</template>
