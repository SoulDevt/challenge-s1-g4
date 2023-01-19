import { defineStore } from "pinia";
import { ENTRYPOINT } from "../../config/entrypoint";
import { ref } from "vue";
import { useRoute } from 'vue-router';


export const useUserStore = defineStore("user", () => {
  const token = ref(null);
  const idUser = ref(null)
  const register = async (email, name, password) => {
    const response = await fetch(`${ENTRYPOINT}/users`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email,
        name,
        password,
      }),
    });
    if (response.ok) {
      console.log("User created");
      //await login(email, password);
    } else {
      throw new Error(response.statusText);
    }
  };
  const login = async (email, password) => {
    const response = await fetch(ENTRYPOINT + "/auth", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ email, password }),
    });
    console.log(response)
    if (response.ok) {
      token.value = await response.json().then((data) => data.token);
    } else {
      throw new Error("Invalid credentials");
    }
  };

  const updateUser = async (email, name, password) => {
    const route = useRoute();
    idUser.value = route.params.id;
    console.log(idUser)
    const response = await fetch(ENTRYPOINT + `/users/${idUser.value}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email,
        name,
        password,
      }),
    });
    if (response.ok) {
      console.log("User updated successfully");
      //await login(email, password);
    } else {
      throw new Error(response.statusText);
    }
  };


  const logout = async () => {
    const response = await fetch(ENTRYPOINT + "/auth/logout", {
      method: "POST",
    });

    if (response.ok) {
      token.value = null;
    } else {
      throw new Error("Logout failed");
    }
  };

  return {
    token,
    register,
    login,
    logout,
    updateUser
  };
});
