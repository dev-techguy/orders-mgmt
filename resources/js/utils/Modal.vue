<template>
    <div class="modal">
        <div class="modal-content" :style="{'width': modalWidth, 'min-height': modalHeight}">
            <div class="modal-body">
                <span class="close" @click="closeModal">&times;</span>
                <h3>{{ title }}</h3>
                <div class="mt-4 border-t border-default-edge-grey px-4 w-full text-left pt-4">
                    <slot></slot>
                </div>
            </div>
            <div class="modal-footer">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        methods: {
            proceed() {
                this.$emit('canProceed');
                this.closeAlertBox();
            },
            closeModal() {
                this.$emit('modalClosed');
            }
        },
        computed: {
            modalWidth() {
                return `${this.width}%`
            },
            modalHeight() {
                return `${this.height}%`
            }
        },
        components: {},
        created() {
            document.addEventListener('keydown', (e) => {
                if(e.keyCode === 27) {
                    this.closeModal();
                }
            });
        },
        props: {
            title: {required: true},
            width: {default: 40},
            height: {default: 54}
        }
    }
</script>

<style scoped>
    .modal {
        display: block;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.7);
        padding-top: 5%;
    }
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        border: 1px solid #888;
        /* width: 70%; */
        border-radius: 3px;
        /* min-height: 400px; */
    }
    .modal-body {
        padding: 20px 0;
        display: block;
        text-align: center;
        border-top: 1px solid #ebebeb;
    }
    .modal-footer {
        /* border-top: 1px solid #ebebeb; */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        height: 50px;
    }
    .modal-footer .btn {
        font-size: 16px;
        margin-right: 10px;
    }
    .btn-outline {
        background: #fff;
        color: #000;
    }
    .danger {
        border: 1px solid #d9534f;
        color: #d9534f;
    }
    .danger:hover {
        background: #d9534f;
        color: #fff;
    }
    .default {
        border: 1px solid #90979b;
    }
    .default:hover {
        background: #90979b;
        color: #fff;
    }
    .close {
        position: absolute;
        background-color: red;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-size: 16px;
        /* font-weight: bold; */
        right: 10px;
        top: 10px;
        cursor: pointer;
        z-index: 1;
        color: white;
    }
</style>