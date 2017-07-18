<template>
    <div>
        <p class="control" :class="{ 'is-loading' : uploading }">
            <input v-if="!uploading" class="input" :disabled="uploading" type="file" @change="fileChange" :name="sendAs">
            <div class="help is-danger" v-if="errors[this.sendAs]" v-text="errors[this.sendAs][0]"></div>

            <div v-if="avatar.path">
                <input type="hidden" name="avatar_id" :value="avatar.id">
                <div class="column is-one-quarter-desktop is-narrow">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-square">
                                <img :src="avatar.path">
                            </figure>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="button is-danger is-fullwidth" @click.prevent="deleteAvatar">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </p>
    </div>
</template>

<script>
    import upload from '../../mixins/upload'

    export default {
        props: [
            'currentAvatar',
            'value',
        ],
        data () {
            return {
                errors: [],
                avatar: {
                    id: this.value,
                    path: this.currentAvatar
                },
            }
        },
        mixins: [
            upload
        ],
        methods: {
            fileChange (e) {
                this.upload(e).then((response) => {
                    this.avatar = response.data.data
                }).catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data
                        return
                    }

                    this.errors = 'Something went wrong. Try again.'
                })
            },

            deleteAvatar () {
                this.avatar = {
                    id: null,
                    path: null,
                }
            }
        },

        watch: {
            'avatar.id' (id) {
                this.$emit('input', id)
            }
        }
    }
</script>
