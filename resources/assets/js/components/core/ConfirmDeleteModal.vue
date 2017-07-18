<template>
    <modal-card v-if="showModal">
        <template slot="title">Are you sure?</template>
        
        Are you sure you would like to delete X?

        <template slot="footer">
            <button class="button is-danger">Yes, delete!</button>
            <button class="button">Cancel</button>
        </template>
    </modal-card>
</template>

<script>
    import { ModalCard } from './'

    export default {
        data () {
            return {
                showModal: false,
            }
        }
    }
</script>