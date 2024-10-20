<script lang="ts" setup>
import Stats from "./Stats.vue";
import Separator from "./ui/separator/Separator.vue";
import PokemonCardDetails from "@/Components/PokemonCardDetails.vue";

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
        :class="`w-3/4 h-3/4 rounded-xl flex justify-center items-center drop-shadow-xl`"
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
            <img :src="pokemon.image_artwork" alt="" class="size-1/2 z-10"/>

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
                <Separator/>
                <div class="w-full text-center text-wrap">
                    <p class="sm:text-sm md:text-md lg:text-lg">
                        {{ pokemon.description }}
                    </p>
                </div>
            </div>
        </div>
        <div
            class="w-1/2 h-[98%] bg-gray-200 rounded-tl-3xl rounded-bl-3xl drop-shadow-2xl"
        >
            <div>
                <PokemonCardDetails :pokemon="pokemon" :objects="objects"/>
            </div>
            <div>
                <div class="text-center font-bold text-3xl p-5">Statistiques</div>
                <Stats
                    v-for="stat in stats"
                    :key="stat.title"
                    :color="objects.typePrimeColor"
                    :value="stat.value"
                >{{ stat.title }}
                </Stats
                >
            </div>
        </div>
    </div>
</template>
