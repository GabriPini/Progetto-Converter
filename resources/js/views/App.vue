<template>
    <main>
        <div class="first-section text-center mt-5">
            <h1 class="fw-bold">Convertitore file</h1>
            <p>
                Converti file, documenti, immagini, video, audio, siti web e
                altro ancora in qualsiasi formato.
            </p>
            <div
                class="container bg-lightblue text-center mt-5 border-3 border-primary rounded border-dashed w-75"
            >
                <img class="mt-4" src="img/cloud.png" alt="" />
                <h5 class="fw-bold mt-1">Trascina qui il tuo file</h5>
                <span class="mt-3">oppure</span>
                <div class="bg-white w-50 mx-auto p-2 mt-3 rounded">
                    <label class="btn btn-default btn-file fw-bold">
                        Scegli i file
                        <input type="file" style="display: none" required />
                    </label>
                    <label class="btn btn-default btn-file fw-bold">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="blue"
                            class="bi bi-folder-plus"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"
                            />
                            <path
                                d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"
                            />
                        </svg>
                        <input type="file" style="display: none" required />
                    </label>
                </div>
                <p class="mb-5 mt-2">
                    100 MB dimensione massima del file oppure
                    <a href="register">Registrati</a>
                </p>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "App",
};
</script>

<style lang="scss" scoped>
.first-section {
    height: 700px;
    width: 100%;
    background-color: #fafcff;
    background-image: url("/img/background-main.png");
    h1 {
        font-size: 64px;
        color: #040b38;
    }
    p {
        color: #818498;
    }
    .border-dashed {
        border-style: dashed;
    }
    .bg-lightblue {
        background-color: #e4ecfc;
    }
}
</style>
