<template>
    <form @submit.prevent="editUser($event)" class="flex flex-col gap-5">
        <div>
            <label for="email" class="block text-sm font-medium text-white"
                >Email</label
            >
            <div class="mt-1">
                <p>{{email}}</p>
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-white"
                >Name</label
            >
            <div class="mt-1">
                <p>{{ name }}</p>
            </div>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-white"
                >Role</label
            >
            <div class="mt-1">
                <p>{{ roles }}</p>
            </div>
        </div>

        <button
            type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Modifier
        </button>
    </form>
</template>

<script setup>
    import { ENTRYPOINT } from "../../config/entrypoint";
    import { ref } from "vue";
    import { useRoute } from 'vue-router';
    const email = ref(null)
    const name = ref(null)
    const roles = ref(null)
    const idUser = ref(null)
    const getUser = async () => {
        const route = useRoute(); 
        const id = route.params.id;
        idUser.value = route.params.id;
        const response = await fetch(ENTRYPOINT + `/users/${id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
        }).then(res => res.json());
        console.log(response)
        if (response) {
            email.value = response.email;
            name.value = response.name;
            if(response.roles = "['ROLE_USER']") {
                roles.value = "User"
            }

        } else {
            throw new Error("Erreur");
        }
    };
    getUser();

    


</script>
