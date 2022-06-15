<script setup>
    import BaseBox from './subComponents/BaseBox.vue'
    import TheLoginForm from './subComponents/TheLoginForm.vue'
</script>

<template>
<div class="login">
    <base-box class="login-box">
        <h1>Se connecter</h1>
        <the-login-form class="login-form"></the-login-form>
    </base-box>
</div>
</template>

<style scoped>
    .login {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    h1 {
        flex-basis: 100%;
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-form {
        display:flex;
        flex-direction: column;
        flex-basis: 100%;
        max-width: 300px;
    }

    .login-box {
        padding: 2rem;
        max-width: 600px;
        border-radius: var(--big-radius);
        box-shadow: var(--shadow);
    }
</style>