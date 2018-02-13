<template>
    <div class="loading center">
        <div class="loading-bar"></div>
    </div>
</template>
<script>
    export default {
        name: "loading"
    }
</script>


<style scoped>
    .loading {
        background-color: lightgrey;
        height: 2px;
        margin: 1em;
        overflow: hidden;
        position: relative;
        width: 12em;
    }
    .loading-bar {
        animation: side2side 2s ease-in-out infinite;
        background-color: #644579;
        height: 100%;
        position: absolute;
        width: 50%;
    }
    @keyframes side2side {
        0%, 100% {
            transform: translateX(-50%);
        }
        50% {
            transform: translateX(150%);
        }
    }
    .center {
        left: 50%;
        margin: 0;
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
    }
</style>