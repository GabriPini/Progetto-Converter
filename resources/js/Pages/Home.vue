<template>
    <div id="body">
        <firstmain-component></firstmain-component>
        <!-- Seconda parte del sito contente la spiegazione di come funziona il programma -->
        <secondmain-component></secondmain-component>
        <!-- terza parte del sito contenente i vantaggi del convertitore  -->
        <thirdmain-component></thirdmain-component>
    </div>
</template>

<script>
import FirstmainComponent from "../components/FirstmainComponent.vue";
import SecondmainComponent from "../components/SecondmainComponent.vue";
import ThirdmainComponent from "../components/ThirdmainComponent.vue";
export default {
    name: "Home",
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
