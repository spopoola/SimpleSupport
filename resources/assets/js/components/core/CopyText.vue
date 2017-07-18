<template>
    <div
        @mouseover="hover = true" 
        @mouseleave="hover = false"
        :class="['click-to-copy', { 'copying' : copying }]"
        :data-clipboard-text="text"
        ref="copy"
    >
        <span>
            {{ text }}
            <a href="#" @click.prevent="" v-show="hover">Copy</a>
            <a href="#" @click.prevent="" class="fadeOutUp animated" v-if="copying">Copied</a>
        </span>
    </div>
</template>

<script>
    import Clipboard from 'clipboard'
    
    export default {
        props: {
            text: {
                required: false,
            }
        },

        mounted() {
            let vm = this
            let clipboard = new Clipboard(this.$refs.copy);

            clipboard.on('success', (e) => {
                vm.copying = true
                setTimeout(() => {
                    vm.copying = false
                }, 400)
            });
        },

        data() {
            return {
                hover: false,
                copying: false,
            }
        }
    }
</script>

<style lang="scss" scoped>
    .click-to-copy {
        max-width: 400px;
        overflow: hidden;
        text-overflow: ellipsis;

        a {
            position: absolute;
            margin-left: 5px;
        }

        span {
            cursor: pointer;
        }
    }
</style>