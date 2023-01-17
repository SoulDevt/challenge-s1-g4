<!--Get Greetings from Api Platform-->
<template v-if="isAdmin">
    <main>
        <h1>Admin</h1>
    </main>
</template>


<script setup>
    import {useUserStore} from "../stores/user";
    import jwtDecode from "jwt-decode";
    let isAdmin = false;
    let token = localStorage.getItem("token");
    let decoded = jwtDecode(token);
    if (decoded.roles.includes("ROLE_ADMIN")) {
        isAdmin = true;
    } else {
        window.location.href = "/";
    }
</script>
