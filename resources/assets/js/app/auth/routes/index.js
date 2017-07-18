import { Login } from '../components'

export default [
    {
        path: '/',
        component: Login,
        name: 'login',

        meta: {
            guest: true,
            needsAuth: false
        }
    }
]
