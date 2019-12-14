<template>
    <div class="modal">
        <div class="modal-content">
            <div class="modal-body">
                <div class="flex justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 50 50">
                        <circle cx="25" cy="25" r="25" fill="#fd7e14"></circle>
                        <path fill="none" stroke="#FFF" stroke-width="4" stroke-linecap="round"
                              stroke-miterlimit="10" d="M25 37v2M18 16c0-3.9 3.188-7.054 7.1-7 3.717.053 6.848 3.183 6.9 6.9.035 2.512-1.252 4.724-3.21 5.987-2.435 1.57-3.79 4.374-3.79 7.27V32">
                        </path>
                    </svg>
                </div>
                <slot></slot>
            </div>
            <div class="modal-footer">
                <button class="app-btn btn-outline danger" @click="proceed">YES</button>
                <button class="app-btn btn-outline default ml-2" @click="closeAlertBox">NO, CANCEL</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        proceed() {
            this.$emit('canProceed');
            this.closeAlertBox();
        },
        closeAlertBox() {
            this.$emit('alertClosed');
        }
    },
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
        padding-top: 2%;
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        border: 1px solid #888;
        width: 30%;
        border-radius: 7px;
    }

    .modal-body {
        padding: 20px;
        display: block;
        text-align: center;
    }

    .modal-footer {
        border-top: 1px solid #ebebeb;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        height: 50px;
    }

    .modal-footer .btn {
        font-size: 13px;
        margin-right: 10px;
    }

    .btn-outline {
        @apply font-normal bg-white text-gray-800;
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
</style>
