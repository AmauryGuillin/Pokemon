<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from "@/Components/ui/card";
import { Link } from "@inertiajs/vue3";

const props = defineProps<{
    pokemon: any;
}>();
</script>

<template>
    <Link :href="`/pokedex/${pokemon.name}`">
        <Card class="hover:scale-[1.03] cursor-pointer transition-all">
            <CardHeader>
                <CardTitle class="capitalize">{{ pokemon.name }}</CardTitle>
            </CardHeader>
            <CardContent class="flex justify-center items-center">
                <img
                    :src="pokemon.image_artwork"
                    :alt="pokemon.name"
                    class="size-1/2"
                />
            </CardContent>
        </Card>
    </Link>
</template>
