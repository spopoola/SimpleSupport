<template>
    <nav class="nav app-navbar has-shadow animated slideInDown" :class="{ slideInDown: show, slideOutDown: !show }">
        <div class="container">
            <div class="nav-left">
                <a class="nav-item">
                    <img src="/images/ss_logo.png">
                </a>
            </div>

            <span class="nav-toggle" @click="toggleSidebar({opened: !sidebar.opened})">
                <span></span>
                <span></span>
                <span></span>
            </span>

            <div class="nav-right nav-menu">
                <a href="" class="nav-item is-tab">
                    <span class="icon">
                        <i class="fa fa-bell-o"></i>
                    </span>
                </a>
                <a class="nav-item is-tab">
                    
                    <figure class="image is-32x32 is-circle" style="margin-right: 8px;">
                        <img :src="$auth.user().thumbnail">
                    </figure>
                    {{ $auth.user().full_name }}
                </a>
               
                <span class="nav-item">
                    <button class="button is-info is-outlined" @click="logout">
                        Log Out
                    </button>
                </span>
            </div>
      </div>
    </nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {

    props: {
        show: Boolean
    },

    computed: mapGetters({
        sidebar: 'sidebar'
    }),

    methods: {
        ...mapActions([
            'toggleSidebar'
        ]),
        logout () {
            this.$auth.logout({
                redirect: 'login',
                makeRequest: false
            })
        }
    }
}
</script>