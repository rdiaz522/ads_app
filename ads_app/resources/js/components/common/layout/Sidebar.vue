<template>
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <router-link to="/home" class="nav-link collapsed">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </router-link>
            </li><!-- End Dashboard Nav -->


            <li class="nav-heading">Pages</li>
            <li class="nav-item">
                <router-link to="/customer-management" class="nav-link collapsed">
                     <i class="bi bi-person"></i>
                    <span>Customer Management</span>
                </router-link>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-contact.html">
                    <i class="bi bi-envelope"></i>
                    <span>Order Management</span>
                </a>
            </li><!-- End Contact Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-login.html">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Inventory Management</span>
                </a>
            </li><!-- End Login Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-error-404.html">
                    <i class="bi bi-dash-circle"></i>
                    <span>Measurement Records</span>
                </a>
            </li><!-- End Error 404 Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-blank.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Design and Customization Options</span>
                </a>
            </li><!-- End Blank Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-blank.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Order Tracking and Notifications</span>
                </a>
            </li><!-- End Blank Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-blank.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Reports and Analytics</span>
                </a>
            </li><!-- End Blank Page Nav -->

            <li class="nav-item">
                <router-link to="/users" class="nav-link collapsed">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </router-link>
            </li><!-- End Blank Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
</template>

<script>
    export default {
        name: "Sidebar.vue"
    }
</script>

<style scoped>

</style>
