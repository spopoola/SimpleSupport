<template>
    <tr>
        <td v-text="ticket.subject"></td>
        <td v-text="ticket.ticket_number"></td>
        <td v-text="assigned"></td>
        <td v-text="ticket.status.data.name" v-bind:style="{ color: ticket.status.data.color}"></td>
        <td v-text="ticket.priority.data.name" v-bind:style="{ color: ticket.priority.data.color}"></td>
        <td>
            <button class="button is-success" @click.prevent="editTicket(ticket)">
                <i class="fa fa-envelope"></i>
            </button>
            </td>

        <td>
            <button class="button is-danger" @click="deleteTicket(ticket)">
                <i class="fa fa-trash"></i>
            </button>
           </td>
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
        },
        methods: {
            ...mapActions({
                deleteTicket: 'tickets/deleteTicket',
            }),

            editTicket (ticket) {
                Events.$emit('ticket-modal', true, ticket)
            }
        }
    }
</script>