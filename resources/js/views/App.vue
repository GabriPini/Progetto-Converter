<template>
    <main>
        <!-- Prima sezione del sito contenente l'area per la conversione file -->
        <firstmain-component></firstmain-component>
        <!-- Seconda parte del sito contente la spiegazione di come funziona il programma -->
        <secondmain-component></secondmain-component>
        <!-- terza parte del sito contenente i vantaggi del convertitore  -->
        <thirdmain-component></thirdmain-component>
    </main>
</template>

<script>
import FirstmainComponent from "../components/FirstmainComponent.vue";
import SecondmainComponent from "../components/SecondmainComponent.vue";
import ThirdmainComponent from "../components/ThirdmainComponent.vue";
export default {
    name: "App",
    components: {
        FirstmainComponent,
        SecondmainComponent,
        ThirdmainComponent,
    },
};
</script>

<style lang="scss">
@import "resources/sass/style.scss";
</style>
