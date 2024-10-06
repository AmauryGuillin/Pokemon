<script setup lang="ts">
import { Badge } from "@/Components/ui/badge";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import { Separator } from "@/Components/ui/separator";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps<{
    pokemon: any;
}>();
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex justify-center w-full h-screen p-10">
            <div>
                <Card>
                    <CardHeader>
                        <CardTitle>
                            <span class="capitalize">{{ pokemon.name }}</span>
                        </CardTitle>
                        <CardDescription>
                            <div>Height: {{ pokemon.height }} m</div>
                            <div>Weight: {{ pokemon.weight }} kg</div>
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="flex justify-center items-center">
                            <img
                                :src="pokemon.image_artwork"
                                :alt="pokemon.name + 'image'"
                                class="size-2/4"
                            />
                        </div>
                    </CardContent>
                    <CardFooter>
                        <div>
                            <div class="space-x-2">
                                <Badge v-for="type in pokemon.types">
                                    <span class="capitalize">
                                        {{ type.type.name }}</span
                                    >
                                </Badge>
                            </div>
                            <Separator class="my-4"></Separator>
                            <div class="">
                                {{ pokemon.description }}
                            </div>
                        </div>
                    </CardFooter>
                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
