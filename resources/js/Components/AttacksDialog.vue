<script setup lang="ts">

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger
} from "@/Components/ui/dialog";
import {Badge} from "@/Components/ui/badge";
import {Button} from "@/Components/ui/button";
import {toRaw} from "vue";

const props = defineProps<{
    pokemon: any;
    objects: any;
}>();

</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button variant="outline">
                Plus
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[70dvw] grid-rows-[auto_minmax(0,1fr)_auto] p-0 max-h-[90dvh]">
            <DialogHeader class="p-6 pb-0">
                <DialogTitle class="font-bold text-xl">Attaques</DialogTitle>
                <DialogDescription>
                    Liste de toutes les attaques disponibles pour {{ pokemon.name }}
                </DialogDescription>
            </DialogHeader>
            <div class="grid gap-4 py-4 overflow-y-auto px-6">
                <div class="flex flex-col justify-between h-fit">
                    <div class="flex justify-center items-center w-full h-fit">
                        <table class="w-full text-center">
                            <thead>
                            <tr>
                                <th scope="col" class="w-2/12">Nom</th>
                                <th scope="col" class="w-2/12">Type</th>
                                <th scope="col" class="w-1/12">pp</th>
                                <th scope="col" class="w-1/12">Puissance</th>
                                <th scope="col" class="w-2/12">Precision</th>
                                <th scope="col" class="w-4/12">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="attack in objects.allAttacks" class="border-b-2">
                                <th scope="row" class="w-2/12">{{ attack.name }}</th>
                                <!--                                                            <td class="w-2/12">{{attack.type.name}}</td>-->
                                <td>
                                    <Badge
                                        :style="{ backgroundColor: attack.type.color.value }"
                                    >{{ attack.type.name }}
                                    </Badge
                                    >
                                </td>
                                <td class="w-1/12">{{ attack.pp }}</td>
                                <td class="w-1/12">{{ attack.power ?? 0 }}</td>
                                <td class="w-2/12">{{ attack.accuracy ?? 0 }}</td>
                                <td class="w-4/12">{{ attack.description }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </DialogContent>
    </Dialog>
</template>
