<template>
    <div>
        <a :href="preview" @click.prevent="previewImage">
            <img :src="thumbnail" alt="">
        </a>

        <image-modal 
            :image="preview"
            v-if="showModal"
            @close="showModal = false"
            to="modal-level-3"
        />
    </div>
</template>

<script>
    import ImageModal from './ImageModal'

    export default {
        components: { ImageModal },

        props: ['thumbnail', 'preview'],

        data () {
            return {
                showModal: false,
            }
        },

        methods: {
            previewImage () {
                this.showModal = true
            }
        }
    }
</script>