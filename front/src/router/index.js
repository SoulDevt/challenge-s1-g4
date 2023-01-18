import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
import UpdateUserView from "../views/UpdateUserView.vue";
import AdminView from "../views/AdminView.vue";
import AnnonceView from "../views/AnnonceView.vue";
import ItemsView from "../views/ItemsView.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/register",
      name: "register",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: RegisterView,
    },
    {
      path: "/update-user",
      name: "update-user",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: UpdateUserView,
    },
    {
      path: "/greetings",
      name: "greetings",
      component: () => import("../views/GreetingsView.vue"),
    },
    {
      path: '/admin',
      name: 'admin',
      component: AdminView,
    },
    {
      path: '/logout',
      name: 'logout',
      beforeEnter: (to, from, next) => {
        localStorage.clear();
        next({ name: 'home' });
      }
    },
    {
      path: '/annonces',
      name: 'annonces',
      component: AnnonceView,
    },
    {
      path: '/annonces/:id',
      name: 'annoncesid',
      component: ItemsView,
    },
    {
      path: "/:pathMatch(.*)*",
      name: "not-found",
      component: () => import("../views/NotFoundView.vue"),
    },

  ],
});

export default router;
