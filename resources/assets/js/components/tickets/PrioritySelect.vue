<template>
    <div class="field is-grouped">
        <p class="control" v-for="(priority, ind) in priorities" :key="ind">
            <button 
                class="button"
                :class="{ 'is-success' : value == priority.id }"
                @click="selectPriority(priority.id)"
               
            >
                {{ priority.name }}
            </button>
        </p>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        
        props: ['value'],

        created () {
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

            selectPriority (id) {
                this.$emit('input', id)
            }
        },

    }
</script>
