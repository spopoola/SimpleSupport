<template>
    <tr>
        <td>
            <article class="media">
                <div class="media-left">
                    <figure class="image is-32x32 is-circle">
                        <img :src="user.thumbnail">
                    </figure>
                </div>

                <div class="media-content">
                    <div class="content">
                        <span v-text="user.full_name"></span>
                    </div>
                </div>
            </article>
        </td>
        <td v-text="user.email"></td>
        <td v-text="user.mobile"></td>
        <td>
            <button class="button is-success" @click="editUser(user)">
                <i class="fa fa-pencil"></i>
            </button>

            <button class="button is-danger" @click="deleteUser(user)">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        props: ['user'],

        methods: {
            ...mapActions({
                deleteUser: 'users/deleteUser',
            }),

            editUser (user) {
                Events.$emit('user-modal', true, user)
            }
        }
    }
</script>