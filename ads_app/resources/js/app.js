import "@/bootstrap";
import "@/assets";
import "@/services/api";
import { createApp } from "vue";
import App from "@/App.vue";
import router from "@/router";
import store from "@/store";
import Toast from "vue-toastification";
import "vue-loading-overlay/dist/css/index.css";
import "vue-toastification/dist/index.css";

// Import Bootstrap CSS
import "bootstrap/dist/css/bootstrap.min.css";
// Import Bootstrap JavaScript
import "bootstrap/dist/js/bootstrap.bundle.min.js";

const app = createApp(App);
app.use(router);
app.use(store);
app.use(Toast);
app.mount("#app");
