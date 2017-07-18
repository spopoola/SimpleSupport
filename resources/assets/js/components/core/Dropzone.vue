<template>
    <form :action="url" class="dropzone"></form>
</template>

<script>
    import Dropzone from 'dropzone'
    Dropzone.autoDiscover = false

    import Alert from '../../core/alert'

    export default {
        props: {
            url: {
                required: true,
            },
            responseField: {
                required: false,
                default: 'file'
            }
        },

        data() {
            return {
                dropzone: []
            }
        },

        mounted () {
            let vm = this;
            vm.dropzone = new Dropzone(vm.$el, {
                headers: {
                    'X-Socket-ID': Echo.socketId(),
                    'Authorization': 'Bearer ' + this.$auth.token(),
                },
                maxFilesize: 5000,
                url: vm.url, 
                init() {
                    this.on("success", (data, response) => {
                        Alert.success(response.success)
                        vm.$emit('fileAdded', response[vm.responseField])
                    })

                    this.on("complete", (data) => {

                    })
                }
            })
        },

        watch: {
            url(value) {
                this.dropzone.options.url = value
            }
        }

    }
</script>