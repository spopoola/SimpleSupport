import * as types from './mutation-types'

export default {
    [types.SET_TICKETS_DATA] (state, tickets) {
        state.tickets = tickets
    },
    [types.SET_TICKET_DATA] (state, ticket) {
        state.ticket = ticket
    },
}
