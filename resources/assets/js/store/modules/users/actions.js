import Vue from 'vue'
import * as types from './mutation-types'
import confirmDelete from '../../../core/confirm_delete'

export const fetchUsers = ({ commit }) => {
    return new Promise((resolve, reject) => {
        Vue.axios.get('/api/users')
        .then(({data}) => {
            commit(types.SET_USERS_DATA, data.data)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const fetchUser = ({ commit }, id) => {
    return new Promise((resolve, reject) => {
        Vue.axios.get(`/api/users/${id}`)
        .then(({data}) => {
            commit(types.SET_USER_DATA, data.data)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const resetUser = (({ commit }) => {
    commit(types.SET_USER_DATA, [])
    return Promise.resolve()
})

export const createUser = ({ commit }, form) => {
    return new Promise((resolve, reject) => {
        form.post('/api/users').then(({data}) => {
            commit(types.ADD_USER, data.user)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const updateUser = ({ commit }, form) => {
    return new Promise((resolve, reject) => {
        form.patch(`/api/users/${form.id}`).then(({data}) => {
            commit(types.UPDATE_USER, data.user)
            resolve(data)
        }).catch((error) => reject(error))
    })
}

export const deleteUser = ({ commit }, user) => {
    return new Promise((resolve, reject) => {
        confirmDelete(user.full_name).then(() => {
            Vue.axios.delete(`/api/users/${user.id}`)
            .then(() => {
                commit(types.DELETE_USER, user.id)
                resolve()
            }).catch((error) => reject(error))
        })
    })
}
