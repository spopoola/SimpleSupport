<template>
    <section class="hero is-fullheight bkg-blue is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered is-multiline">
                    <div class="column is-4 is-offset-4 is-mobile">
                        <p class="title is-white is-spaced">SimpleSupport</p>
                        <p class="subtitle is-white is-4">Sign In</p>
                        <div class="box">
                            <form @submit.prevent="login">
                                <div class="field">
                                    <label class="label">Email</label>
                                    <p class="control has-icons-right">
                                        <input type="email" class="input" :class="{ 'is-danger' : error.email }" placeholder="Email" v-model="data.body.email">
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                    </p>
                                    <p class="help is-danger" v-if="error.email" v-text="error.email[0]"></p>
                                </div>

                                <div class="field">
                                    <label class="label">Password</label>
                                    <p class="control has-icons-right">
                                        <input type="password" class="input" :class="{ 'is-danger' : error.password }" placeholder="Password" v-model="data.body.password">
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                    </p>
                                    <p class="help is-danger" v-if="error.password" v-text="error.password[0]"></p>
                                </div>

                                <p class="control">
                                    <button type="submit" class="button is-primary">Login</button>
                                    <p class="help is-danger" v-if="error.root" v-text="error.root"></p>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

    data () {
        return {
            data: {
                body: {
                    email: null,
                    password: null
                },
                rememberMe: false
            },
            error: []
        }
    },

    mounted () {
        if (this.$auth.check()) {
        	var redirect = this.$auth.redirect()
            this.$router.replace({ name: redirect ? redirect.from.name : 'Home', params: redirect ? redirect.from.params : {} })
        }
    },

    methods: {
        login () {
            var redirect = this.$auth.redirect()
            this.$auth.login({
                headers: {
                    'Content-Type': 'application/json'
                },
                data: this.data.body,
                rememberMe: this.data.rememberMe,
                redirect: { name: redirect ? redirect.from.name : 'Home', params: redirect ? redirect.from.params : {} },
                fetchUser: true,
                success (res) {
                },
                error (err) {
                    this.error = err.response.data.errors
                }
            })
        }
    }
}
</script>