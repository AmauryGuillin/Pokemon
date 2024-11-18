<script setup lang="ts">
import { Badge } from "@/Components/ui/badge";
import { Button } from "@/Components/ui/button";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ListFilter } from "lucide-vue-next";

const props = defineProps<{
    pokemon: any;
    attacks: any;
}>();
</script>

<template>
    <AuthenticatedLayout>
        <div
            class="w-full h-full font-poppins"
            :style="{ backgroundColor: pokemon.type_prime.color.value }"
        >
            <div class="flex flex-col justify-center items-center mb-4">
                <img :src="pokemon.image_artwork" alt="" class="size-52" />
                <h1 class="font-bold text-2xl text-white">
                    {{ pokemon.name }}
                </h1>
            </div>
            <div class="flex justify-center items-center pb-2">
                <table class="w-[95vw] text-center bg-white">
                    <thead>
                        <tr>
                            <th scope="col" class="w-2/12">Nom</th>
                            <th scope="col" class="w-2/12">Type</th>
                            <th scope="col" class="w-2/12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="attack in attacks" class="border-b-2">
                            <td scope="row" class="w-2/12">
                                {{ attack.name }}
                            </td>
                            <td>
                                <Badge
                                    :style="{
                                        backgroundColor:
                                            attack.type.color.value,
                                    }"
                                    >{{ attack.type.name }}
                                </Badge>
                            </td>
                            <td>
                                <Button variant="outline"
                                    ><ListFilter
                                /></Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
