<template>
  <div>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title is-4"><i class="fa fa-calendar-plus-o"></i> My Tickets</p>
          <p class="subtitle">{{ ticketStats.user_tickets }}</p>
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title is-4"><i class="fa fa-question-circle-o"></i> Unassigned</p>
          {{ ticketStats.unassigned }}
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title is-4"><i class="fa fa-exclamation-circle"></i> Overdue</p>
          {{ ticketStats.overdue }}
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title is-4"> <i class="fa fa-hourglass-end"></i> Due Today</p>
          {{ ticketStats.due_today }}
        </article>
      </div>
    </div>

    <div class="tile is-ancestor">
      <div class="tile is-parent is-12">
        <article class="tile is-child box">
          <h4 class="title">Unassigned Tickets</h4>
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
    mounted () {
    	this.fetchTickets()
        this.fetchTicketStats()
    },

    computed: {
      ...mapGetters({
          tickets: 'tickets/tickets',
          ticketStats: 'tickets/ticketStats',
      })
    },

    methods: {
      ...mapActions({
    	  fetchTickets: 'tickets/fetchTickets',
          fetchTicketStats: 'tickets/fetchTicketStats',
      }),
    }
  }
</script>
