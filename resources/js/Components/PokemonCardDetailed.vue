<script lang="ts" setup>
import Stats from "./Stats.vue";
import Separator from "./ui/separator/Separator.vue";
import PokemonCardDetails from "@/Components/PokemonCardDetails.vue";
import { toRaw } from "vue";

const props = defineProps<{
    pokemon: any;
    objects: any;
}>();

console.log(toRaw(props.objects));

const stats = [
    {
        title: "PV",
        value: Number(props.pokemon.stat_hp),
    },
    {
        title: "Attaque",
        value: Number(props.pokemon.stat_attack),
    },
    {
        title: "Défense",
        value: Number(props.pokemon.stat_defense),
    },
    {
        title: "Attaque spé",
        value: Number(props.pokemon.stat_special_attack),
    },
    {
        title: "Défense spé",
        value: Number(props.pokemon.stat_special_defense),
    },
    {
        title: "Vitesse",
        value: Number(props.pokemon.stat_speed),
    },
];
</script>

<template>
    <div
        class="w-3/4 h-3/4 rounded-xl flex justify-center items-center drop-shadow-xl"
        :style="{ backgroundColor: objects.typePrimeColor }"
    >
        <div class="w-1/2 h-full flex flex-col justify-center items-center">
            <div class="flex justify-between items-center w-full">
                <span
                    class="font-bold text-white text-4xl pb-5 pl-5 underline"
                    >{{ pokemon.name }}</span
                >
                <span class="font-bold text-white text-4xl pb-5 pr-5"
                    >#{{ String(pokemon.id).padStart(3, "0") }}</span
                >
            </div>
            <img :src="pokemon.image_artwork" alt="" class="size-1/2 z-10" />

            <div
                class="w-full h-1/4 flex flex-col justify-center items-center gap-5 bg-white"
            >
                <div class="flex justify-center items-center w-full gap-5 pt-5">
                    <span
                        :style="{ backgroundColor: objects.typePrimeColor }"
                        class="rounded-full p-2 text-center font-bold w-1/6 cursor-pointer hover:scale-[1.03] transition-all duration-150"
                        >{{ objects.typePrime }}</span
                    >
                    <span
                        v-if="objects.typeSecond"
                        :style="{ backgroundColor: objects.typeSecondColor }"
                        class="rounded-full p-2 text-center font-bold w-1/6 cursor-pointer hover:scale-[1.03] transition-all duration-150"
                        >{{ objects.typeSecond }}</span
                    >
                </div>
                <Separator />
                <div class="w-full text-center text-wrap">
                    <p class="sm:text-sm md:text-md lg:text-lg">
                        {{ pokemon.description }}
                    </p>
                </div>
            </div>
        </div>
        <div
            class="w-1/2 h-[98%] bg-gray-200 rounded-tl-3xl rounded-bl-3xl drop-shadow-2xl flex flex-col justify-between"
        >
            <div>
                <PokemonCardDetails :pokemon="pokemon" :objects="objects" />
            </div>
            <div>
                <Stats
                    v-for="stat in stats"
                    :key="stat.title"
                    :color="objects.typePrimeColor"
                    :value="stat.value"
                    >{{ stat.title }}
                </Stats>
            </div>
            <div class="">
                <div class="grid grid-cols-5 w-full text-center p-5">
                    <div>
                        <img
                            :src="objects.evolutions.first.image_artwork"
                            :alt="objects.evolutions.name"
                        />
                        <span>{{ objects.evolutions.first.name }}</span>
                    </div>
                    <div
                        v-if="
                            objects.evolutions.middle || objects.evolutions.last
                        "
                        class="flex justify-center items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-chevrons-right"
                        >
                            <path d="m6 17 5-5-5-5" />
                            <path d="m13 17 5-5-5-5" />
                        </svg>
                    </div>
                    <div v-if="objects.evolutions.middle">
                        <img
                            :src="objects.evolutions.middle.image_artwork"
                            :alt="objects.evolutions.name"
                        />
                        <span>{{ objects.evolutions.middle.name }}</span>
                    </div>
                    <div
                        v-if="objects.evolutions.middle"
                        class="flex justify-center items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-chevrons-right"
                        >
                            <path d="m6 17 5-5-5-5" />
                            <path d="m13 17 5-5-5-5" />
                        </svg>
                    </div>
                    <div v-if="objects.evolutions.last">
                        <img
                            :src="objects.evolutions.last.image_artwork"
                            :alt="objects.evolutions.name"
                        />
                        <span>{{ objects.evolutions.last.name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
