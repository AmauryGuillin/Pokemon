<script setup lang="ts">
import {
    Card,
    CardContent,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import { Link } from "@inertiajs/vue3";
import { Badge } from "./ui/badge";

const props = defineProps<{
    pokemon: any;
}>();
</script>

<template>
    <Link :href="`/pokedex/${pokemon.name}`">
        <Card
            class="hover:scale-[1.03] cursor-pointer transition-all border-2 rounded-t-sm drop-shadow-md"
            :style="{ borderColor: pokemon.type_prime.color.value }"
        >
            <CardHeader
                class="rounded-bl-3xl rounded-br-3xl p-2 drop-shadow-lg"
                :style="{ backgroundColor: pokemon.type_prime.color.value }"
            >
                <CardTitle
                    class="flex justify-between items-baseline text-white"
                >
                    <span class="capitalize ml-5">{{ pokemon.name }}</span>
                    <span class="text-lg font-bold mr-5"
                        >#{{ String(pokemon.number).padStart(3, "0") }}</span
                    >
                </CardTitle>
            </CardHeader>
            <CardContent class="flex justify-center items-center p-5">
                <img
                    :src="pokemon.image_artwork"
                    :alt="pokemon.name"
                    class="size-1/2"
                />
            </CardContent>
            <CardFooter class="gap-2">
                <Badge
                    :style="{ backgroundColor: pokemon.type_prime.color.value }"
                    >{{ pokemon.type_prime.name }}
                </Badge>
                <Badge
                    :style="{
                        backgroundColor: pokemon.type_second.color.value,
                    }"
                    v-if="pokemon.type_second_id"
                    >{{ pokemon.type_second.name }}
                </Badge>
            </CardFooter>
        </Card>
    </Link>
</template>
