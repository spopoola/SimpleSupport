import Vue from 'vue'
import * as types from './mutation-types'

export const fetchPriorities = ({commit}) => {
    return new Promise((resolve, reject) => {
        Vue.axios.get('/api/ticket-priorities')
        .then(({data}) => {
            commit(types.SET_PRIORITIES_DATA, data.data)
            resolve(data)
        }).catch((error) => reject(error))
    })
}
