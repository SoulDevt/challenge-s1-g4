import { defineStore } from "pinia";
import { ENTRYPOINT } from "../../config/entrypoint";
import { ref } from "vue";

export const useUserStore = defineStore("user", () => {
  const token = ref(null);

  const login = async (email, password) => {
    const response = await fetch(ENTRYPOINT + "/auth", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ email, password }),
    });

    if (response.ok) {
      token.value = await response.json().then((data) => data.token);
    } else {
      throw new Error("Invalid credentials");
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
    login,
    logout,
  };
});
