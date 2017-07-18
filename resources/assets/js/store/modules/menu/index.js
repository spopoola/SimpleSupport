import * as types from '../../mutation-types'
import lazyLoading from './lazyLoading'

// show: meta.label -> name
// name: component name
// meta.label: display label

const state = {
    items: [
        {
            name: 'Home',
            path: '/',
            meta: {
                label: 'Dashboard',
                icon: 'fa-tachometer',
                link: 'dashboard/index.vue',
                auth: true,
            },
            component: lazyLoading('dashboard', true)
        },
        {
            name: 'User Settings',
            meta: {
                icon: 'fa-cog',
                expanded: false
            },

            children: [
                {
                    name: 'users.index',
                    path: '/users',
                    meta: {
                        label: 'Users',
                        link: 'users/index.vue',
                        auth: true,
                    },
                    component: lazyLoading('users', true)
                },
                {
                    name: 'profile',
                    path: '/profile',
                    meta: {
                        label: 'My Profile',
                        link: 'users/Profile.vue',
                        auth: true,
                    },
                    component: lazyLoading('users/Profile')
                }
            ]
        },
        
    ]
}

const mutations = {
    [types.EXPAND_MENU] (state, menuItem) {
        if (menuItem.index > -1) {
            if (state.items[menuItem.index] && state.items[menuItem.index].meta) {
                state.items[menuItem.index].meta.expanded = menuItem.expanded
            }
        } else if (menuItem.item && 'expanded' in menuItem.item.meta) {
            menuItem.item.meta.expanded = menuItem.expanded
        }
    }
}

export default {
    state,
    mutations
}
