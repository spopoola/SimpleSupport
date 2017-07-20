<template>
    <tr>
        <td v-text="ticket.subject"></td>
        <td v-text="ticket.ticket_number"></td>
        <td v-text="assigned"></td>
        <td v-text="ticket.status.data.name" v-bind:style="{ color: ticket.status.data.color}"></td>
        <td v-text="ticket.priority.data.name" v-bind:style="{ color: ticket.priority.data.color}"></td>
    </tr>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        props: ['ticket'],

        computed: {
            assigned() {
                if (_.isEmpty(this.ticket.user)) {
                    return 'Unassigned'
                } else {
                    return this.ticket.user.data.full_name
                }
            }
        }
    }
</script>