<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent is-12">
                <article class="tile is-child box">
                    <h4 class="title">My Tickets</h4>
                    <div class="content">
                        <tickets-list :tickets="tickets"></tickets-list>
                    </div>
                </article>
            </div>
        </div>
        <ticket-modal />
    </div>
</template>

<script>

    import { mapActions, mapGetters } from 'vuex'
    import { TicketsList, TicketModal } from '../../components/tickets'

    export default {

        computed: {
            ...mapGetters({
                tickets: 'tickets/tickets',
            })
        },

        methods: {
            ...mapActions({
                fetchTickets: 'tickets/fetchTickets',
            }),
        }
    }
</script>
