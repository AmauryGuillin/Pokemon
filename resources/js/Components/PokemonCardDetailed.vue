<script setup lang="ts">
import Stats from "./Stats.vue";
import Separator from "./ui/separator/Separator.vue";

const props = defineProps<{
    pokemon: any;
    objects: any;
}>();

const stats = [
    {
        title: "PV",
        value: props.pokemon.stat_hp,
    },
    {
        title: "Attaque",
        value: props.pokemon.stat_attack,
    },
    {
        title: "Défense",
        value: props.pokemon.stat_defense,
    },
    {
        title: "Attaque spé",
        value: props.pokemon.stat_special_attack,
    },
    {
        title: "Défense spé",
        value: props.pokemon.stat_special_defense,
    },
    {
        title: "Vitesse",
        value: props.pokemon.stat_speed,
    },
];
</script>

<template>
    <div
        :class="`w-3/4 h-3/4 rounded-xl flex justify-center items-center drop-shadow-xl`"
        :style="{ backgroundColor: objects.typePrimeColor }"
        style="backdrop-filter: 'blur(100px)"
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
            <img class="size-1/2 z-10" :src="pokemon.image_artwork" alt="" />

            <div
                class="w-full h-1/4 flex flex-col justify-center items-center gap-5 bg-white"
            >
                <div class="flex justify-center items-center w-full gap-5 pt-5">
                    <span
                        class="rounded-full p-2 text-center font-bold w-1/6 cursor-pointer hover:scale-[1.03] transition-all duration-150"
                        :style="{ backgroundColor: objects.typePrimeColor }"
                        >{{ objects.typePrime }}</span
                    >
                    <span
                        v-if="objects.typeSecond"
                        class="rounded-full p-2 text-center font-bold w-1/6 cursor-pointer hover:scale-[1.03] transition-all duration-150"
                        :style="{ backgroundColor: objects.typeSecondColor }"
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
            class="w-1/2 h-full bg-gray-200 rounded-tl-3xl rounded-bl-3xl drop-shadow-2xl"
        >
            <div class="text-center font-bold text-3xl p-3">Details</div>
            <Stats
                v-for="stat in stats"
                :value="stat.value"
                :key="stat.title"
                :color="objects.typePrimeColor"
                >{{ stat.title }}</Stats
            >
        </div>
    </div>
</template>
