<script lang="ts" setup>
import Stats from "@/Components/Stats.vue";
import Separator from "./ui/separator/Separator.vue";
import PokemonCardDetails from "@/Components/PokemonCardDetails.vue";
import { ChevronsRight } from "lucide-vue-next";
import { toRaw } from "vue";
import { Badge } from "@/Components/ui/badge";

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
        class="size-2/3 rounded-xl 2xl:flex justify-center items-center drop-shadow-xl grid"
        :style="{ backgroundColor: objects.typePrimeColor }"
    >
        <section class="lg:w-1/2 h-full">
            <header>
                <h1
                    class="flex justify-between items-baseline text-white text-3xl font-bold p-5"
                >
                    <span class="underline">{{ pokemon.name }}</span>
                    <span>#{{ String(pokemon.number).padStart(3, "0") }}</span>
                </h1>
            </header>
            <div class="flex justify-center">
                <img
                    :src="pokemon.image_artwork"
                    alt=""
                    class="size-1/2 z-10"
                />
            </div>
            <div class="bg-white h-1/4">
                <section class="flex gap-5 justify-center pt-5">
                    <Badge
                        class="text-black font-bold px-4 py-1 cursor-pointer hover:scale-[1.03] transition-all duration-150"
                        :style="{ backgroundColor: objects.typePrimeColor }"
                    >
                        {{ objects.typePrime }}
                    </Badge>
                    <Badge
                        class="text-black font-bold px-4 py-1 cursor-pointer hover:scale-[1.03] transition-all duration-150"
                        :style="{ backgroundColor: objects.typeSecondColor }"
                    >
                        {{ objects.typeSecond }}
                    </Badge>
                </section>
                <Separator class="my-5" />
                <section class="flex justify-center">
                    <p class="sm:text-xs md:text-sm lg:text-md">
                        {{ pokemon.description }}
                    </p>
                </section>
            </div>
        </section>
        <div
            class="lg:w-1/2 h-[98%] bg-gray-200 rounded-tl-3xl rounded-bl-3xl drop-shadow-2xl grid gap-5 justify-between p-5"
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
                    <div v-if="objects.evolutions.first">
                        <img
                            :src="objects.evolutions.first.image_artwork"
                            :alt="objects.evolutions.name"
                        />
                        <span class="font-bold">{{
                            objects.evolutions.first.name
                        }}</span>
                    </div>
                    <div
                        v-if="
                            objects.evolutions.first &&
                            objects.evolutions.middle
                        "
                        class="flex justify-center items-center"
                    >
                        <ChevronsRight />
                    </div>
                    <div v-if="objects.evolutions.middle">
                        <img
                            :src="objects.evolutions.middle.image_artwork"
                            :alt="objects.evolutions.name"
                        />
                        <span class="font-bold">{{
                            objects.evolutions.middle.name
                        }}</span>
                    </div>
                    <div
                        v-if="objects.evolutions.middle"
                        class="flex justify-center items-center"
                    >
                        <ChevronsRight />
                    </div>
                    <div v-if="objects.evolutions.last">
                        <img
                            :src="objects.evolutions.last.image_artwork"
                            :alt="objects.evolutions.name"
                        />
                        <span class="font-bold">{{
                            objects.evolutions.last.name
                        }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
