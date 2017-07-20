import Vue from 'vue'
import * as types from './mutation-types'

export const fetchTickets = ({ commit }) => {
    return new Promise((resolve, reject) => {
        Vue.axios.get('/api/tickets')
        .then(({data}) => {
            commit(types.SET_TICKETS_DATA, data.data)
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
            commit(types.ADD_TICKET, data.ticket)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const updateTicket = ({ commit }, form) => {
    return new Promise((resolve, reject) => {
        form.patch(`/api/tickets/${form.id}`).then(({data}) => {
            commit(types.UPDATE_TICKET, data.ticket)
            resolve(data)
        }).catch((error) => reject(error))
    })
}
