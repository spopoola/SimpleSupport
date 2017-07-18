<template>
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <h4 class="title">Users</h4>
                <div class="table-responsive">
                    <table class="table is-bordered is-striped is-narrow">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody v-if="users.length">
                            <user-row :key="user.id" :user="user" v-for="user in users"></user-row>
                        </tbody>

                        <tbody v-else>
                            <tr>
                                <td colspan="4">There are not users created.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { UserRow } from './'

    export default {
        props: ['users'],
    }
</script>