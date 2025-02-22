<script setup lang="ts">
import { Ruler, Swords, Weight } from "lucide-vue-next";
import PokeBallSvg from "./PokeBallSvg.vue";
import Badge from "./ui/badge/Badge.vue";

const props = defineProps<{
    pokemon: any;
    objects: any;
}>();

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
    <section class="w-[80dvw] h-full bg-white font-poppins">
        <div
            class="mt-5 mb-3 px-10 bg-[#DC0A2D] w-fit rounded-tr-lg rounded-br-lg"
        >
            <div class="font-bold text-4xl text-white">{{ pokemon.name }}</div>
        </div>
        <div class="px-5 bg-[#DC0A2D] w-fit rounded-tr-lg rounded-br-lg">
            <div class="font-bold text-2xl text-white">
                N°{{ String(pokemon.number).padStart(3, "0") }}
            </div>
        </div>
        <section
            class="relative flex justify-center items-center mt-5 shadow-md"
            :style="{ background: pokemon.type_prime.color.value }"
        >
            <div class="flex flex-col justify-center items-center">
                <img
                    :src="pokemon.image_artwork"
                    :alt="pokemon.name + 'image'"
                    class="h-72 z-50"
                />
                <div
                    class="flex justify-center items-center gap-4 bg-white px-32 py-2 rounded-tr-xl rounded-tl-xl shadow-lg"
                >
                    <Badge
                        :style="{
                            backgroundColor: pokemon.type_prime.color.value,
                        }"
                        >{{ pokemon.type_prime.name }}
                    </Badge>
                    <Badge
                        :style="{
                            backgroundColor: pokemon.type_second.color.value,
                        }"
                        v-if="pokemon.type_second_id"
                        >{{ pokemon.type_second.name }}
                    </Badge>
                </div>
            </div>
            <PokeBallSvg
                class="absolute top-[11vh] left-[40vw] scale-[15] opacity-10 z-0"
            />
        </section>
        <section class="flex flex-col justify-center items-center gap-5">
            <div
                class="mt-5 px-5 py-3 text-xl italic font-semibold bg-gray-100 rounded-md shadow-md"
            >
                "{{ pokemon.description }}"
            </div>
            <h1
                class="w-full text-center mt-4 font-bold text-3xl"
                :style="{ color: pokemon.type_prime.color.value }"
            >
                A propos
            </h1>
            <div class="grid grid-cols-3 mt-5 w-[70%] text-2xl">
                <div
                    class="grid justify-center items-center gap-3 border-r-2 border-gray-300 text-center"
                >
                    <div class="flex justify-center items-center gap-2">
                        <Weight />
                        <div class="text-3xl font-semibold w-full">
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
                        <div class="text-3xl font-semibold w-full">
                            {{ pokemon.height }} m
                        </div>
                    </div>
                    <div class="font-light">Taille</div>
                </div>
                <div
                    class="grid justify-center items-center h-full w-full gap-2 text-center"
                >
                    <div class="flex justify-center items-center gap-4">
                        <Swords />
                        <div class="flex flex-col justify-center items-start">
                            <span
                                v-for="attack in objects.attackNames"
                                class="text-2xl font-bold"
                            >
                                {{ attack }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-center items-center gap-2">
                        <div class="font-light w-full">Attaques</div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>
