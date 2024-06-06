<template>
    <div  class="dark:bg-gray-900">
        <!--    Sidebar-->
<!--        <Sidebar :class="{'-ml-[200px]': !sidebarOpened}"/>-->
        <!--/    Sidebar-->

        <div class="flex-1">
<!--            <Navbar &lt;!&ndash;@toggle-sidebar="toggleSidebar" &ndash;&gt;></Navbar>-->
            <Navbar></Navbar>
            <!--      Content-->
            <main class="p-6">
                <router-view></router-view>
            </main>
            <!--      Content-->
        </div>
    </div>
    <div class="min-h-full bg-gray-200 flex items-center justify-center">
<!--        <Spinner />-->
    </div>
<!--    <Toast />-->
</template>

<script setup>

import Navbar from "./Navbar.vue";
</script>

<style scoped>

</style>
