import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
import UpdateUserView from "../views/UpdateUserView.vue";
import AdminView from "../views/AdminView.vue";
import UpgradeVendorView from "../views/upgradeVendorView.vue";
import AdminUpgradeDemandsView from "../views/AdminUpgradeDemandsView.vue";
import AdminCreateAuctionView from "../views/AdminCreateAuction.vue";
import ProfilView from "../views/ProfilView.vue";
import AnnonceView from "../views/AnnonceView.vue";
import ItemsView from "../views/ItemsView.vue";
import AddAnnonceView from "../views/AddAnnoncesView.vue";

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
      path: "/update-user/:id",
      name: "update-user",
      props: true,
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: UpdateUserView,
    },
    {
      path: "/upgrade-vendor",
      name: "upgrade-vendor",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: UpgradeVendorView,
    },
    {
      path: "/pannel-upgrade-vendor",
      name: "pannel-upgrade-vendor",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: AdminUpgradeDemandsView,
    },
    {
      path: "/pannel-create-auction",
      name: "pannel-create-auction",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: AdminCreateAuctionView,
    },
    {
      path: "/success",
      name: "stripe-success",
      component: () => import("../views/StripeSuccessView.vue"),
    },
    {
      path: "/cancel",
      name: "stripe-cancel",
      component: () => import("../views/StripeCancelView.vue"),
    },
    {
      path: "/forgot-password",
      name: "forgot-password",
      component: () => import("../views/ForgotPasswordView.vue"),
    },
    {
      path: "/reset-password/:token",
      name: "reset-password",
      component: () => import("../views/ResetPasswordView.vue"),
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
      path: '/profile',
      name: 'profile',
      component: ProfilView,
    },
    {
      path: '/profile/:id',
      name: 'profile',
      props: true,
      component: ProfilView,
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
      path: '/annonces/create',
      name: 'annonces_new',
      component: AddAnnonceView,
    },
    {
      path: "/:pathMatch(.*)*",
      name: "not-found",
      component: () => import("../views/NotFoundView.vue"),
    },

  ],
});

export default router;
