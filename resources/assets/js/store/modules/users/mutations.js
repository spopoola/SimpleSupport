import * as types from './mutation-types'

export default {
    [types.SET_USERS_DATA] (state, users) {
        state.users = users
    },
    [types.SET_USER_DATA] (state, user) {
        state.user = user
    },
    [types.ADD_USER] (state, user) {
        state.users.push(user)
    },
    [types.UPDATE_USER] (state, updatedUser) {
        let existing = state.users.find(((user) => user.id === updatedUser.id))

        if (existing) {
            for (let field in updatedUser) {
                existing[field] = updatedUser[field]
            }
        }
    },
    [types.DELETE_USER] (state, id) {
        state.users = state.users.filter((user) => user.id !== id)
    },
}
