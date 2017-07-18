<template>
	<portal :to="to">
        <div class="modal is-active" @keyup.esc="$emit('close')" :class="{ 'modal-dialog-animating' : errors }">
            <div class="modal-background" @click="$emit('close')"></div>
            <div class="modal-card" :class="[{ 'modal-content-animating--shake' : errors }, { 'fadeInDown animated' : !loaded }]">
                <header class="modal-card-head">
                    <p class="modal-card-title">
                        <slot name="title"></slot>
                    </p>
                    <button class="delete" @click="$emit('close')"></button>
                </header>
                <section class="modal-card-body">
                    <slot></slot>
                </section>
                <footer class="modal-card-foot">
                    <slot name="footer"></slot>
                </footer>
            </div>
        </div>
    </portal>
</template>

<script>
    export default {
        props: {
            to: {
                default: 'modal-level-1',
            },

            errors: {
                default: false,
            }
        },

        created () {
            setTimeout(() => {
                this.loaded = true
            }, 1000)
        },

        data () {
            return {
                loaded: false,
            }
        },
    }
</script>

<style scoped>
    .modal-dialog-animating {
        -webkit-perspective: 800px;
        perspective: 800px;
    }

    .modal-content-animating--shake {
        -webkit-animation-duration: .4s;
        animation-duration: .4s;
        -webkit-animation-timing-function: ease-in-out;
        animation-timing-function: ease-in-out;
        -webkit-animation-name: inputShake;
        animation-name: inputShake
    }

    @-webkit-keyframes inputShake {
        0% {
            -webkit-transform: translateX(0);
            transform: translateX(0)
        }

        12.5% {
            -webkit-transform: translateX(-6px) rotateY(-5deg);
            transform: translateX(-6px) rotateY(-5deg)
        }

        37.5% {
            -webkit-transform: translateX(5px) rotateY(4deg);
            transform: translateX(5px) rotateY(4deg)
        }

        62.5% {
            -webkit-transform: translateX(-3px) rotateY(-2deg);
            transform: translateX(-3px) rotateY(-2deg)
        }

        87.5% {
            -webkit-transform: translateX(2px) rotateY(1deg);
            transform: translateX(2px) rotateY(1deg)
        }

        to {
            -webkit-transform: translateX(0);
            transform: translateX(0)
        }
    }

    @keyframes inputShake {
        0% {
            -webkit-transform: translateX(0);
            transform: translateX(0)
        }

        12.5% {
            -webkit-transform: translateX(-6px) rotateY(-5deg);
            transform: translateX(-6px) rotateY(-5deg)
        }

        37.5% {
            -webkit-transform: translateX(5px) rotateY(4deg);
            transform: translateX(5px) rotateY(4deg)
        }

        62.5% {
            -webkit-transform: translateX(-3px) rotateY(-2deg);
            transform: translateX(-3px) rotateY(-2deg)
        }

        87.5% {
            -webkit-transform: translateX(2px) rotateY(1deg);
            transform: translateX(2px) rotateY(1deg)
        }

        to {
            -webkit-transform: translateX(0);
            transform: translateX(0)
        }
    }
</style>