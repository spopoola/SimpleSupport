<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent is-12">
                <article class="tile is-child box">
                    <h4 class="title" v-text="$route.meta.label"></h4>
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
        watch: {
            type: {
                handler () {
                    this.fetchTickets(this.type)
                },
                immediate: true,
            }
        },

        computed: {
            ...mapGetters({
                tickets: 'tickets/tickets',
            }),

            type () {
                return this.$route.meta.type ? this.$route.meta.type : ''
            }
        },

        methods: {
            ...mapActions({
                fetchTickets: 'tickets/fetchTickets',
            }),
        }
    }
</script>
