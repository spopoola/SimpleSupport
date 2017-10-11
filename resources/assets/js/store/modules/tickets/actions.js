import Vue from 'vue'
import * as types from './mutation-types'
import confirmDelete from '../../../core/confirm_delete'

export const fetchTickets = ({ commit }, type) => {
    return new Promise((resolve, reject) => {
        commit(types.SET_TICKETS_DATA, [])
        Vue.axios.get(`/api/tickets/type/${type}`)
        .then(({data}) => {
            commit(types.SET_TICKETS_DATA, data.data)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const fetchTicketStats = ({ commit }) => {
    return new Promise((resolve, reject) => {
        Vue.axios.get('/api/tickets/stats')
            .then(({data}) => {
                commit(types.SET_TICKET_STATS_DATA, data)
                resolve(data)
            }).catch((error) => reject(error))
    })
}

export const fetchTicket = ({ commit }, id) => {
    return new Promise((resolve, reject) => {
        Vue.axios.get(`/api/ticket/${id}`)
        .then(({data}) => {
            commit(types.SET_TICKET_DATA, data.data)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const createTicket = ({ commit }, form) => {
    return new Promise((resolve, reject) => {
        form.post('/api/tickets').then(({data}) => {
            commit(types.ADD_TICKET, data)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const updateTicket = ({ commit }, form) => {
    return new Promise((resolve, reject) => {
        form.patch(`/api/tickets/${form.id}`).then(({data}) => {
            commit(types.UPDATE_TICKET, data)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const deleteTicket = ({ commit }, ticket) => {
    return new Promise((resolve, reject) => {
        confirmDelete('Ticket ' + ticket.ticket_number).then(() => {
            Vue.axios.delete(`/api/tickets/${ticket.id}`)
                .then(() => {
                    commit(types.DELETE_TICKET, ticket.id)
                    resolve()
                }).catch((error) => reject(error))
        })
    })
}
