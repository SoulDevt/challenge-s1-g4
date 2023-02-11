import { defineStore } from "pinia";
import { ENTRYPOINT } from "../../config/entrypoint";
import { ref } from "vue";

export const useUserStore = defineStore("annonces", () => {
  const token = ref(null);
  const addAnnonce = async (title,description,price,image,liens,tags,author) => {
    const response = await fetch(`${ENTRYPOINT}/annonces_posts`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        title,
        description,
        price,
        image,
        liens,
        tags,
        author
      }),
    });
    if (response.ok) {
      console.log("Annonce has been submitted");
      //await login(email, password);
    } else {
      throw new Error(response.statusText);
    }
  };

  return {
    addAnnonce
  };
});
