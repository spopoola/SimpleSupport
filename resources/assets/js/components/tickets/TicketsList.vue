<template>
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <div class="table-top">
                    <h4 class="title">Tickets</h4>
                    <button class="button is-success" @click.prevent="addTicket">Create Ticket</button>
                </div>
                <div class="table-responsive">
                    <table class="table is-bordered is-striped is-narrow">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Ticket ID</th>
                                <th>Agent</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>

                        <tbody v-if="tickets.length">
                            <ticket-row :key="ticket.id" :ticket="ticket" v-for="ticket in tickets"></ticket-row>
                        </tbody>

                        <tbody v-else>
                            <tr>
                                <td colspan="7">There are no tickets created.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { TicketRow } from './'

    export default {
        props: ['tickets'],

        methods: {
            addTicket () {
                Events.$emit('ticket-modal', true)
            }
        }
    }
</script>
