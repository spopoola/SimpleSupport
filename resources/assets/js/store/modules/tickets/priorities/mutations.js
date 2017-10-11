import * as types from './mutation-types'

export default {
    [types.SET_PRIORITIES_DATA] (state, priorities) {
        state.priorities = priorities
    }
}
