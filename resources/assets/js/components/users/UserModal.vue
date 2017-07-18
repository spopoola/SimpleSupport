<template>
    <modal-card 
        v-if="showModal" 
        @close="showModal = false"
        :errors="form.errors.any()"
    >
        <template slot="title">
            <span v-text="isEdit ? `Editing ${form.full_name}'s user` : 'Create New User'"></span>
        </template>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Email</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <input type="text" class="input" :class="{ 'is-danger' : form.errors.has('email') }" placeholder="Email" v-model="form.email">
                    <span class="help is-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Password</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <input type="password" class="input" :class="{ 'is-danger' : form.errors.has('password') }" placeholder="Password" v-model="form.password">
                    <span class="help is-danger" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Confirm Password</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <input type="password" class="input" :class="{ 'is-danger' : form.errors.has('password_confirmation') }" placeholder="Confirm Password" v-model="form.password_confirmation">
                    <span class="help is-danger" v-if="form.errors.has('password_confirmation')" v-text="form.errors.get('password_confirmation')"></span>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">First Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <input type="text" class="input" :class="{ 'is-danger' : form.errors.has('first_name') }" placeholder="First Name" v-model="form.first_name">
                    <span class="help is-danger" v-if="form.errors.has('first_name')" v-text="form.errors.get('first_name')"></span>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Last Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <input type="text" class="input" :class="{ 'is-danger' : form.errors.has('last_name') }" placeholder="Last Name" v-model="form.last_name">
                    <span class="help is-danger" v-if="form.errors.has('last_name')" v-text="form.errors.get('last_name')"></span>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Mobile</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <input type="text" class="input" :class="{ 'is-danger' : form.errors.has('mobile') }" placeholder="Mobile" v-model="form.mobile">
                    <span class="help is-danger" v-if="form.errors.has('mobile')" v-text="form.errors.get('mobile')"></span>
                </div>
            </div>
        </div>

        <template slot="footer">
            <button class="button is-primary" @click="storeUser" v-text="isEdit ? 'Save' : 'Create'"></button>
            <button class="button" @click="showModal = false">Cancel</button>
        </template>
    </modal-card>
</template>

<script>
    import { mapActions } from 'vuex'
    import Form from '../../core/form/form'

    export default {
        created () {
            Events.$on('user-modal', (trueOrFalse, user = false) => {
                this.showModal = trueOrFalse
                if (user) {
                    user.password = null
                    user.password_confirmation = null
                    this.form = new Form(user)
                } else {
                    this.form = new Form({
                        email: null,
                        first_name: null,
                        last_name: null,
                        password: null,
                        password_confirmation: null,
                        mobile: null,
                    })
                }
            })
        },

        data () {
            return {
                showModal: false,
                form: new Form
            }
        },

        computed: {
            isEdit () {
                return !! this.form.id
            }
        },

        methods: {
            ...mapActions({
                createUser: 'users/createUser',
                updateUser: 'users/updateUser',
            }),

            storeUser () {
                if (this.isEdit) {
                    this.updateUser(this.form).then(() => this.showModal = false)
                } else {
                    this.createUser(this.form).then(() => this.showModal = false)
                }
                
            },
        }
    }
</script>