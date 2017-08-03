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

        {
            name: 'Tickets',
            meta: {
                icon: 'fa-envelope',
                expanded: false
            },

            children: [
                {
                    name: 'users.tickets',
                    path: '/tickets/user',
                    meta: {
                        label: 'My Tickets',
                        link: 'tickets/TicketsList.vue',
                        type: 'user',
                        auth: true,
                    },
                    component: lazyLoading('tickets', true)
                },
                {
                    name: 'tickets.index',
                    path: '/tickets/unassigned',
                    meta: {
                        label: 'Unassigned',
                        link: 'tickets/index.vue',
                        auth: true,
                        type: 'unassigned',
                    },
                    component: lazyLoading('tickets', true)
                },

                {
                    name: 'tickets.overdue',
                    path: '/tickets/overdue',
                    meta: {
                        label: 'Overdue',
                        link: 'tickets/index.vue',
                        auth: true,
                        type: 'overdue',
                    },
                    component: lazyLoading('tickets', true)
                },
                {
                    name: 'tickets.due-today',
                    path: '/tickets/due-today',
                    meta: {
                        label: 'Due Today',
                        link: 'tickets/index.vue',
                        auth: true,
                        type: 'due_today',
                    },
                    component: lazyLoading('tickets', true)
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
