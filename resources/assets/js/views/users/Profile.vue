<template>
    <div>
        <div class="columns">
            <div class="column is-half-tablet is-one-third-desktop">
                <div class="box">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-128x128 is-circle">
                                <img :src="$auth.user().thumbnail">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-3" v-text="$auth.user().full_name"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="box">
                    <p class="title is-4">Update your profile</p>
                
                    <form @submit.prevent="updateProfile">
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

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label for="name" class="label">Profile Picture</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <avatar-upload endpoint="/api/users/avatar" v-model="form.avatar_id" :currentAvatar="$auth.user().thumbnail ? $auth.user().thumbnail : ''"/>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="field is-grouped">
                            <p class="control">
                                <button type="submit" class="button is-primary">Save</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from '../../core/form/form'
    import { AvatarUpload } from '../../components/users/'

    export default {
        data () {
            return {
                form: new Form(this.formData(), false),
            }
        },

        methods: {
            formData () {
                let userData = this.$auth.user()

                userData.password = null
                userData.password_confirmation = null

                return userData
            },
            
            updateProfile () {
                this.form.patch('/api/users/profile')
                .then(() => {
                    this.$auth.fetch({
                        success() {
                            this.form = new Form(this.$auth.user(), false)
                        },
                    })
                })
            }
        }
    }
</script>