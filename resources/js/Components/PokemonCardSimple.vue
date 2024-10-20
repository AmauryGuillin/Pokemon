<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle, CardFooter } from "@/Components/ui/card";
import { Link } from "@inertiajs/vue3";
import { Badge } from "./ui/badge";

const props = defineProps<{
    pokemon: any;
}>();
</script>

<template>
    <Link :href="`/pokedex/${pokemon.name}`">
        <Card class="hover:scale-[1.03] cursor-pointer transition-all">
            <CardHeader>
                <CardTitle class="flex justify-between items-center">
                    <span class="capitalize">{{ pokemon.name }}</span>
                    <span class="text-lg font-bold">#{{ String(pokemon.number ).padStart("3", 0)}}</span>
                </CardTitle>
            </CardHeader>
            <CardContent class="flex justify-center items-center">
                <img
                    :src="pokemon.image_artwork"
                    :alt="pokemon.name"
                    class="size-1/2"
                />
            </CardContent>
            <CardFooter class="gap-2">
                <Badge
                    :style="{ backgroundColor: pokemon.type_prime.color.value }"
                    >{{ pokemon.type_prime.name }}</Badge
                >
                <Badge
                    :style="{
                        backgroundColor: pokemon.type_second.color.value,
                    }"
                    v-if="pokemon.type_second_id"
                    >{{ pokemon.type_second.name }}</Badge
                >
            </CardFooter>
        </Card>
    </Link>
</template>
