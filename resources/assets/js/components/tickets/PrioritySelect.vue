<template>
    <div class="field">
        <div class="control">
            <div class="select" :class="{ 'is-danger' : hasErrors }">
                <select v-model="priority_id">
                    <option value="">Select Priority</option>
                    <option
                        :value="priority.id"
                        v-for="(priority, ind) in priorities"
                        :key="ind"
                    >
                        {{ priority.name }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {

        props: ['value', 'hasErrors'],

        data () {
            return {
                priority_id: this.value,
            }
        },

        created() {
            this.fetchPriorities()
        },

        computed: {
            ...mapGetters({
                priorities: 'ticket_priorities/priorities'
            })
        },

        methods: {
            ...mapActions({
                fetchPriorities: 'ticket_priorities/fetchPriorities',
            }),
        },

        watch: {
            priority_id (id) {
                this.$emit('input', id)
            }
        }

    }
</script>
