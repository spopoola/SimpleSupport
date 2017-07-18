<template>
    <v-select
        :class="{ 'is-danger': errors }"
        :options="options" 
        :on-search="getOptions"
        :on-change="updateValue"
        placeholder="Search Users"
        label="full_name"
        :value="selected"
        ref="select"
    />
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        props: ['value', 'errors', 'focus'],

        created () {
            this.fetchUsers().then(() => {
                this.options = this.users
            })
        },

        data () {
            return {
                options: [],
            }
        },

        computed: {
            ...mapGetters({
                users: 'users/users',
            }),

            selected () {
                return this.users.find((user) => user.id === this.value)
            }
        },

        methods: {
            ...mapActions({
                fetchUsers: 'users/fetchUsers',
            }),

            getOptions(search, loading) {
                loading(true)
                this.options = this.users.filter((user) => user.full_name.toLowerCase().indexOf(search.toLowerCase()) !== -1)
                loading(false)
            },

            updateValue (user) {
                let id = 0
                if (user !== null) {
                    id = user.id
                }
                this.$emit('input', id)
            }
        }
    }
</script>