<template>
    <modal-card
            v-if="showModal"
            @close="showModal = false"
            :errors="form.errors.any()">
        <template slot="title">
            <span v-text="isEdit ? `Editing ${form.subject}` : 'Create New Ticket'"></span>
        </template>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="subject" class="label">Subject</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <input type="text" class="input" :class="{ 'is-danger' : form.errors.has('subject') }" placeholder="Subject" v-model="form.subject">
                    <span class="help is-danger" v-if="form.errors.has('subject')" v-text="form.errors.get('subject')"></span>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="content" class="label">Content</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <vue-editor v-model="form.content"></vue-editor>
                    <!-- <textarea class="textarea" :class="{ 'is-danger' : form.errors.has('password') }" placeholder="content" v-model="form.content"></textarea> -->
                    <span class="help is-danger" v-if="form.errors.has('content')" v-text="form.errors.get('content')"></span>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="content" class="label">Priority</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <priority-select v-model="form.priority_id" :has-errors="form.errors.has('priority_id')" />
                    <span class="help is-danger" v-if="form.errors.has('priority_id')" v-text="form.errors.get('priority_id')"></span>
                </div>
            </div>
        </div>


        <template slot="footer">
            <button class="button is-primary" @click="storeTicket" v-text="isEdit ? 'Save' : 'Create'"></button>
            <button class="button" @click="showModal = false">Cancel</button>
        </template>
    </modal-card>
</template>

<script>
    import { mapActions } from 'vuex'
    import Form from '../../core/form/form'
    import { VueEditor } from 'vue2-editor'
    import { PrioritySelect } from './'

    export default {

        components: {
          VueEditor,
          PrioritySelect,
        },

        created () {
            Events.$on('ticket-modal', (trueOrFalse, ticket = false) => {
                this.showModal = trueOrFalse
                if (ticket) {
                    this.form = new Form(ticket)
                } else {
                    this.form = new Form({
                        subject: null,
                        content: null,
                        priority_id: '',
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
                createTicket: 'tickets/createTicket',
                updateTicket: 'tickets/updateTicket',
            }),

            storeTicket () {
                if (this.isEdit) {
                    this.updateTicket(this.form).then(() => this.showModal = false)
                } else {
                    this.createTicket(this.form).then(() => this.showModal = false)
                }

            },
        }

    }
</script>
