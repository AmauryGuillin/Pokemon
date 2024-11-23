<script setup lang="ts">
import { Badge } from "@/Components/ui/badge";
import { Separator } from "@/Components/ui/separator";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ArrowLeft, CircleArrowDown } from "lucide-vue-next";

const props = defineProps<{
    pokemon: any;
    evolutionList: any;
}>();
</script>

<template>
    <AuthenticatedLayout>
        <section
            class="w-full min-h-[calc(100vh-4rem)] font-poppins sm:hidden p-4"
            :style="{
                backgroundColor: pokemon.type_prime.color.value,
            }"
        >
            <header class="relative">
                <h1 class="text-center text-white font-bold text-2xl w-full">
                    Evolutions
                </h1>
                <Link
                    :href="`/pokedex/${pokemon.name}`"
                    class="absolute top-0 left-0"
                >
                    <ArrowLeft class="stroke-white scale-150" />
                </Link>
            </header>
            <Separator class="my-4"></Separator>
            <div
                v-for="(pokemon, index) in evolutionList"
                class="flex flex-col justify-center items-center"
            >
                <div
                    class="flex items-center border-2 rounded-full w-full bg-gray-200"
                >
                    <img
                        :src="pokemon.image_artwork"
                        alt=""
                        class="w-32 px-4 rounded-full bg-gray-300"
                    />
                    <div class="ml-4">
                        <div class="font-bold text-xl">
                            {{ pokemon.name }}
                        </div>
                        <div>
                            N°{{ String(pokemon.number).padStart(3, "0") }}
                        </div>
                        <div class="flex items-center gap-2">
                            <Badge
                                :style="{
                                    backgroundColor:
                                        pokemon.type_prime.color.value,
                                }"
                                >{{ pokemon.type_prime.name }}
                            </Badge>
                            <Badge
                                :style="{
                                    backgroundColor:
                                        pokemon.type_second.color.value,
                                }"
                                v-if="pokemon.type_second_id"
                                >{{ pokemon.type_second.name }}
                            </Badge>
                        </div>
                    </div>
                </div>
                <CircleArrowDown
                    v-if="evolutionList.length != index + 1"
                    class="scale-150 stroke-white my-4"
                />
            </div>
        </section>
        <section class="hidden sm:block">Desktop view</section>
    </AuthenticatedLayout>
</template>
