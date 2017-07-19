<template>
  <div>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title is-4"><i class="fa fa-calendar-plus-o"></i> My Tickets</p>
          <p class="subtitle">1</p>
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title is-4"><i class="fa fa-question-circle-o"></i> Unassigned</p>
          <p class="subtitle">10</p>
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title is-4"><i class="fa fa-exclamation-circle"></i> Overdue</p>
          <p class="subtitle">2</p>
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title is-4"> <i class="fa fa-hourglass-end"></i> Due Today</p>
          <p class="subtitle">2</p>
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
  </div>
</template>

<script>

  import { mapActions, mapGetters } from 'vuex'
  import { TicketsList } from '../../components/tickets'

  export default {
    mounted () {
    	this.fetchTickets()
    },

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
