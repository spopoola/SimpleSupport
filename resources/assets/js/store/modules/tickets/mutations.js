import * as types from './mutation-types'

export default {
    [types.SET_TICKETS_DATA] (state, tickets) {
        state.tickets = tickets
    },
    [types.SET_TICKET_STATS_DATA] (state, ticketStats) {
        state.ticketStats = ticketStats
    },
    [types.SET_TICKET_DATA] (state, ticket) {
        state.ticket = ticket
    },
    [types.ADD_TICKET] (state, ticket) {
        state.tickets.push(ticket)
    },
    [types.UPDATE_TICKET] (state, updatedTicket) {
        let existing = state.tickets.find(((ticket) => ticket.id === updatedTicket.id))

        if (existing) {
            for (let field in updatedTicket) {
                existing[field] = updatedTicket[field]
            }
        }
    },
    [types.DELETE_TICKET] (state, id) {
        state.tickets = state.tickets.filter((ticket) => ticket.id !== id)
    },
}
