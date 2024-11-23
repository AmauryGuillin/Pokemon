<script setup lang="ts">
import { Badge } from "@/Components/ui/badge";
import { buttonVariants } from "@/Components/ui/button";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/ui/dialog";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { cn } from "@/lib/utils";
import { Link } from "@inertiajs/vue3";
import { ArrowLeft, ChevronRight } from "lucide-vue-next";

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
            <div
                class="flex flex-col justify-center items-center mb-4 relative"
            >
                <img :src="pokemon.image_artwork" alt="" class="size-52" />
                <h1 class="font-bold text-2xl text-white">
                    {{ pokemon.name }}
                </h1>
                <Link
                    :href="`/pokedex/${pokemon.name}`"
                    class="absolute top-3 left-3"
                >
                    <ArrowLeft class="stroke-white scale-150" />
                </Link>
            </div>
            <div class="flex justify-center items-center pb-2">
                <table class="w-[95vw] text-center bg-white rounded-xl">
                    <thead>
                        <tr>
                            <th scope="col" class="w-2/12">Nom</th>
                            <th scope="col" class="w-2/12">Type</th>
                            <th scope="col" class="w-2/12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(attack, index) in attacks"
                            :class="
                                cn(index != attacks.length - 1 && 'border-b-2')
                            "
                        >
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
                            <td class="p-2">
                                <Dialog>
                                    <DialogTrigger
                                        :class="
                                            buttonVariants({
                                                variant: 'outline',
                                                size: 'icon',
                                            })
                                        "
                                    >
                                        <ChevronRight />
                                    </DialogTrigger>
                                    <DialogContent class="w-[85vw] rounded-xl">
                                        <DialogHeader>
                                            <DialogTitle>{{
                                                attack.name
                                            }}</DialogTitle>
                                            <DialogDescription>
                                                <div
                                                    class="flex flex-col justify-center items-center gap-2 mt-3"
                                                >
                                                    <div class="text-start">
                                                        <div>
                                                            <span>PP : </span
                                                            ><span
                                                                class="font-bold"
                                                                >{{
                                                                    attack.pp
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div>
                                                            <span
                                                                >Puissance :
                                                            </span>
                                                            <span
                                                                class="font-bold"
                                                                >{{
                                                                    attack.power
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div>
                                                            <span
                                                                >Précision :
                                                            </span>
                                                            <span
                                                                class="font-bold"
                                                                >{{
                                                                    attack.accuracy
                                                                }}</span
                                                            >
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span class="italic">{{
                                                            attack.description
                                                        }}</span>
                                                    </div>
                                                </div>
                                            </DialogDescription>
                                        </DialogHeader>
                                    </DialogContent>
                                </Dialog>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
