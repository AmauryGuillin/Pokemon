<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
import { ArrowLeft, Ruler, Weight } from "lucide-vue-next";
import { toRaw } from "vue";
import PokeBallSvg from "./PokeBallSvg.vue";
import Stats from "./Stats.vue";
import { Badge } from "./ui/badge";
import { Button } from "./ui/button";

const props = defineProps<{
    pokemon: any;
    objects: any;
}>();

console.log(toRaw(props.pokemon));

const stats = [
    {
        title: "PV",
        value: Number(props.pokemon.stat_hp),
    },
    {
        title: "ATK",
        value: Number(props.pokemon.stat_attack),
    },
    {
        title: "DEF",
        value: Number(props.pokemon.stat_defense),
    },
    {
        title: "SATK",
        value: Number(props.pokemon.stat_special_attack),
    },
    {
        title: "SDEF",
        value: Number(props.pokemon.stat_special_defense),
    },
    {
        title: "VIT",
        value: Number(props.pokemon.stat_speed),
    },
];
</script>

<template>
    <section
        class="w-full h-full relative font-poppins"
        :style="{ backgroundColor: pokemon.type_prime.color.value }"
    >
        <section class="h-full">
            <header
                class="w-full text-white flex justify-between items-center p-5"
            >
                <div class="flex justify-center items-center gap-3">
                    <Link :href="`/pokedex`">
                        <Button variant="ghost" size="icon">
                            <ArrowLeft class="stroke-white scale-150" />
                        </Button>
                    </Link>
                    <p class="font-bold text-2xl">{{ pokemon.name }}</p>
                </div>
                <p class="font-bold">
                    N°{{ String(pokemon.number).padStart(3, "0") }}
                </p>
            </header>
            <section class="flex flex-col h-[calc(100%-80px)]">
                <div
                    class="flex-1 items-end border-2 m-1 mb-2 rounded-xl bg-[#EFEFEF] shadow-lg relative mt-48"
                >
                  <img
                      :src="pokemon.image_artwork"
                      :alt="pokemon.name + 'image'"
                      class="absolute left-1/2 -translate-x-1/2 -top-36 h-48"
                  />
                    <div class="flex justify-center items-center mt-14 gap-4">
                        <Badge
                            :style="{
                                backgroundColor: pokemon.type_prime.color.value,
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
                    <div
                        class="w-full text-center mt-4 font-bold text-lg"
                        :style="{ color: pokemon.type_prime.color.value }"
                    >
                        A propos
                    </div>
                    <div class="grid grid-cols-3 mt-5 w-full">
                        <div
                            class="grid justify-center items-center gap-3 border-r-2 border-gray-300 text-center"
                        >
                            <div class="flex justify-center items-center gap-2">
                                <Weight />
                                <div class="text-sm font-semibold w-full">
                                    {{ pokemon.weight }} kg
                                </div>
                            </div>
                            <div class="font-light">Poids</div>
                        </div>
                        <div
                            class="grid justify-center items-center gap-3 border-r-2 border-gray-300 text-center"
                        >
                            <div class="flex justify-center items-center gap-2">
                                <Ruler />
                                <div class="text-sm font-semibold w-full">
                                    {{ pokemon.height }} m
                                </div>
                            </div>
                            <div class="font-light">Taille</div>
                        </div>
                        <div
                            class="grid justify-center items-center h-full w-full gap-2 text-center"
                        >
                            <div class="flex justify-center items-center gap-4">
                                <div
                                    class="flex flex-col justify-center items-start"
                                >
                                    <span
                                        v-for="attack in objects.attackNames"
                                        class="text-xs"
                                    >
                                        {{ attack }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <div class="text-sm font-light w-full">
                                    Attaques
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 w-full text-sm text-center">
                        {{ pokemon.description }}
                    </div>
                    <div>
                        <div
                            class="w-full text-center mt-4 font-bold text-lg"
                            :style="{ color: pokemon.type_prime.color.value }"
                        >
                            Statistiques de base
                        </div>
                        <div class="px-4 pt-2 text-xs">
                            <Stats
                                v-for="stat in stats"
                                :key="stat.title"
                                :color="objects.typePrimeColor"
                                :value="stat.value"
                                >{{ stat.title }}
                            </Stats>
                        </div>
                    </div>
                    <div
                        class="flex justify-center items-center gap-4 mt-3 w-full"
                    >
                        <Link :href="`/pokemon/${pokemon.name}/attack/`">
                            <Button variant="outline">Attaques</Button>
                        </Link>
                        <Button variant="outline">Evolutions</Button>
                    </div>
                </div>
            </section>
        </section>
    </section>

    <PokeBallSvg
        class="absolute top-[22vh] right-[32vw] scale-[10] opacity-10"
    />
</template>
