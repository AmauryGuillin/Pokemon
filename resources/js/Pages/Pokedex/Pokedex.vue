<script setup lang="ts">
import PokeBallSvg from "@/Components/PokeBallSvg.vue";
import PokemonCardPokedexD from "@/Components/PokemonCardPokedexD.vue";
import PokemonCardPokedexM from "@/Components/PokemonCardPokedexM.vue";
import { Badge } from "@/Components/ui/badge";
import { Button } from "@/Components/ui/button";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/ui/dialog";
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
        <section class="bg-[#DC0A2D] flex flex-col h-[calc(100vh-4rem)]">
            <header class="grid items-center gap-2 py-3 px-3">
                <section class="flex items-center gap-3">
                    <PokeBallSvg />
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
                    <!-------------------->
                    <!-- Mobile View drawer -->
                    <!-------------------->
                    <div class="sm:hidden">
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
                    <!-------------------->
                    <!-- Mobile View dialog -->
                    <!-------------------->
                    <div class="hidden sm:block">
                        <Dialog>
                            <DialogTrigger>
                                <Button variant="outline" size="icon">
                                    <Filter />
                                </Button>
                            </DialogTrigger>
                            <DialogContent>
                                <DialogHeader>
                                    <DialogTitle>Tri par type</DialogTitle>
                                    <DialogDescription
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
                                    </DialogDescription>
                                </DialogHeader>
                            </DialogContent>
                        </Dialog>
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
                    class="grid grid-cols-[repeat(auto-fill,minmax(270px,1fr))] w-full h-fit gap-3"
                >
                    <div v-for="pokemon in usablePokemonList">
                        <PokemonCardPokedexD
                            :pokemon="pokemon"
                        ></PokemonCardPokedexD>
                    </div>
                </div>
            </section>
        </section>
    </AuthenticatedLayout>
</template>
