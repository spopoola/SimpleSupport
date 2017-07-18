<template>
    <button
        type="button"
        class="button" 
        :class="[value ? 'is-success' : 'is-danger']"
        @click="toggleButton"
    >
        {{ buttonText }}
    </button>
</template>

<script>
    export default {
        props: {
            value: {
                required: true,
                default: false,
            },

            buttonTrueText: {
                default: 'Yes',
                type: String,
            },

            buttonFalseText: {
                default: 'No',
                type: String,
            }
        },

        computed: {
            buttonText () {
                return this.value ? this.buttonTrueText : this.buttonFalseText
            }
        },

        methods: {
            toggleButton () {
                this.$emit('changed', !this.value)
                this.$emit('input', !this.value)
            }
        }
    }
</script>