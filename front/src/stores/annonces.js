import { defineStore } from "pinia";
import { ENTRYPOINT } from "../../config/entrypoint";
import { ref } from "vue";

export const useUserStore = defineStore("annonces", () => {
  const token = ref(null);
  const addAnnonce = async (title,description,prix,image,lien,tags,author) => {
    const response = await fetch(`${ENTRYPOINT}/pubs`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        title,
        description,
        prix,
        image,
        lien,
        tags,
        author
      }),
    });
    if (response.ok) {
      console.log("pub has been submitted");
      //await login(email, password);
    } else {
      throw new Error(response.statusText);
    }
  };

  return {
    addAnnonce
  };
});
