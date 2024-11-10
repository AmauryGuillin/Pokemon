<script setup lang="ts">
import { Card } from "@/Components/ui/card";
import { Link } from "@inertiajs/vue3";
import { toRaw } from "vue";
import { Badge } from "./ui/badge";

const props = defineProps<{
    pokemon: any;
}>();
</script>

<template>
    <Link :href="`/pokedex/${pokemon.name}`">
        <Card
            class="max-h-1/5 grid grid-cols-[2fr_1fr] bg-[#F0ECF3] cursor-pointer"
        >
            <div class="pl-3 flex flex-col justify-evenly">
                <div>N°{{ String(pokemon.number).padStart(3, "0") }}</div>
                <div class="font-bold text-xl capitalize">
                    {{ pokemon.name }}
                </div>
                <div class="flex items-center gap-3">
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
            <div>
                <img
                    :src="pokemon.image_artwork"
                    :alt="pokemon.name"
                    class="rounded-lg border-2 border-[#F0ECF3]"
                    :style="{
                        backgroundColor: pokemon.type_prime.color.value,
                    }"
                />
            </div>
        </Card>
    </Link>
</template>
