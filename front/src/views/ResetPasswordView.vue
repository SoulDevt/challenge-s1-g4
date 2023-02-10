<template>
    <form @submit.prevent="resetPassword($event)" class="flex flex-col gap-5">
        <label for="password" class="block text-sm font-medium text-white"
            >Mot de passe</label
        >
        <div class="mt-1">
            <input
                type="password"
                name="password"
                id="password"
                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
        </div>
        <label for="password" class="block text-sm font-medium text-white"
            >Confirmation du mot de passe</label
        >
        <div class="mt-1">
            <input
                type="password"
                name="password"
                id="password"
                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
        </div>
        <button
            type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Réinitialiser le mot de passe
        </button>
    </form>
</template>

<script setup>
async function resetPassword(event) {
    console.log(event);
}
</script>
