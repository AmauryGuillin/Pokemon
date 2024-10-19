<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3'

const props = defineProps<{
    pikachuImage: string;
    salamecheImage: string;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Choisissez une activité</div>
                </div>
            </div>
        </div>

        <div class="flex justify-center items-center w-full gap-5">
             <Link :href="'/pokedex'">
                <Card
                    class="cursor-pointer hover:scale-[1.03] transition-all h-48 w-64"
                >
                    <CardHeader>
                        <CardTitle>Le Pokedex</CardTitle>
                        <CardDescription
                            >Pokemon de la 1ere génération</CardDescription
                        >
                    </CardHeader>
                    <CardContent class="flex justify-center items-center">
                        <img :src="pikachuImage" alt="pikachu image" />
                        <img :src="salamecheImage" alt="pikachu image" />
                    </CardContent>
                </Card>
             </Link>
            <Card
                class="cursor-pointer hover:bg-red-300 transition-all h-48 w-64"
            >
                <CardHeader>
                    <CardTitle>Prochainement...</CardTitle>
                    <CardDescription>Prochainement...</CardDescription>
                </CardHeader>
                <CardContent class="flex justify-center items-center">
                    Prochainement...
                </CardContent>
            </Card>
        </div>
    </AuthenticatedLayout>
</template>
