<template>
    <portal :to="to">
        <div class="modal is-active" @keyup.esc="$emit('close')">
            <div class="modal-background" @click="$emit('close')"></div>
            <div class="modal-content zoomIn animated">
                <p class="image">
                    <a :href="image" target="_blank">
                        <img :src="image">
                    </a>
                </p>
            </div>
            <button class="modal-close is-large" @click="$emit('close')"></button>
        </div>
    </portal>
</template>

<script>
    export default {
        props: {
            to: {
                default: 'modal-level-1',
            },

            image: {
                default: '',
                required: true,
            }
        },
    }
</script>
