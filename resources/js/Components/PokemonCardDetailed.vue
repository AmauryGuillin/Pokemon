<script lang="ts" setup>
import Stats from "./Stats.vue";
import Separator from "./ui/separator/Separator.vue";
import {Button} from "@/Components/ui/button";
import {toRaw} from "vue";

const props = defineProps<{
    pokemon: any;
    objects: any;
}>();

console.log(toRaw(props.objects))

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
                <div class="text-center font-bold text-3xl p-5">Details</div>
                <div class="grid grid-cols-[33%_33%_33%] items-center justify-center text-center">
                    <div class="flex flex-col justify-center items-center border-r-2 border-gray-300 h-full space-y-5">
                        <div class="flex justify-center items-center gap-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="lucide lucide-weight"><circle cx="12" cy="5" r="3"/><path
                                    d="M6.5 8a2 2 0 0 0-1.905 1.46L2.1 18.5A2 2 0 0 0 4 21h16a2 2 0 0 0 1.925-2.54L19.4 9.5A2 2 0 0 0 17.48 8Z"/></svg>
                            </span>
                            <span>Masse</span>
                        </div>
                        <div>
                            <span class="font-bold text-2xl">{{ pokemon.weight }} kg</span>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center items-center border-r-2 border-gray-300 h-full space-y-5">
                        <div class="flex justify-center items-center gap-2">
                            <span>
                                <svg class="lucide lucide-ruler" fill="none" height="24" stroke="currentColor"
                                     stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                     width="24" xmlns="http://www.w3.org/2000/svg"><path
                                    d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path
                                    d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path
                                    d="m17.5 15.5 2-2"/></svg>
                            </span>
                            <span>Taille</span>
                        </div>
                        <div>
                            <span class="font-bold text-2xl">{{ pokemon.height }} m</span>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center items-center h-full space-y-5">
                        <div class="flex justify-center items-center gap-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="lucide lucide-swords"><polyline
                                    points="14.5 17.5 3 6 3 3 6 3 17.5 14.5"/><line x1="13" x2="19" y1="19" y2="13"/><line
                                    x1="16" x2="20" y1="16" y2="20"/><line x1="19" x2="21" y1="21" y2="19"/><polyline
                                    points="14.5 6.5 18 3 21 3 21 6 17.5 9.5"/><line x1="5" x2="9" y1="14" y2="18"/><line
                                    x1="7" x2="4" y1="17" y2="20"/><line x1="3" x2="5" y1="19" y2="21"/></svg>
                            </span>
                            <span>Attaques</span>
                        </div>
                        <div class="flex justify-center items-center gap-4 ">
                            <div class="flex flex-col justify-center items-start">
                                <span v-for="attack in objects.attackNames">
                                    {{attack}}
                                </span>
                            </div>
                            <div>
                                <Button variant="outline">Plus</Button>
                            </div>
                        </div>

                    </div>
                </div>
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
