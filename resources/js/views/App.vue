<template>
    <main>
        <!-- Prima sezione del sito contenente l'area per la conversione file -->

        <form
            class="first-section text-center mt-5 mb-5"
            method="get"
            enctype="multipart/form-data"
            @submit.prevent="apiCall"
        >
            <h1 class="fw-bold">Convertitore file</h1>
            <p>
                Converti file, documenti, immagini, video, audio, siti web e
                altro ancora in qualsiasi formato.
            </p>

            <div
                id="file-drag-drop"
                class="container bg-lightblue text-center mt-5 border-3 border-primary rounded border-dashed"
                v-show="files <= 0"
            >
                <div ref="fileform">
                    <img class="mt-4" src="img/cloud.png" alt="" />
                    <h5 class="fw-bold mt-1">Trascina qui il tuo file</h5>
                    <span class="mt-3">oppure</span>
                    <div class="bg-white w-50 mx-auto p-2 mt-3 rounded">
                        <label class="btn btn-default btn-file fw-bold">
                            Scegli i file
                            <input
                                value="Convert file"
                                type="file"
                                name="File"
                                style="display: none"
                                ref="fileform2"
                            />
                        </label>

                        <label
                            class="btn btn-default btn-file fw-bold custom-icon-color"
                        >
                            <font-awesome-icon
                                icon="fa-solid fa-folder-plus "
                            />
                        </label>
                        <label
                            class="btn btn-default btn-file fw-bold custom-icon-color"
                        >
                            <font-awesome-icon icon="fa-brands fa-dropbox " />
                        </label>
                        <label
                            class="btn btn-default btn-file fw-bold custom-icon-color"
                        >
                            <font-awesome-icon
                                icon="fa-brands fa-google-drive "
                            />
                        </label>
                        <label
                            class="btn btn-default btn-file fw-bold custom-icon-color"
                        >
                            <font-awesome-icon icon="fa-solid fa-cloud " />
                        </label>
                    </div>
                    <p class="mb-5 mt-2">
                        100 MB dimensione massima del file oppure
                        <a href="register">Registrati</a>
                    </p>
                </div>

                <progress
                    max="100"
                    :value.prop="uploadPercentage"
                    class="d-none"
                ></progress>
            </div>
            <div class="conversion">
                <div
                    v-for="(file, key) in files"
                    class="file-listing mt-2 mb-2 bg-white container shadow d-flex justify-content-between align-items-center rounded border-custom"
                    :key="file.index"
                >
                    <span class="fw-bold">{{ file.name }}</span>
                    <div
                        class=""
                        v-if="
                            file.type.split('/')[1] === 'pdf' ||
                            file.type.split('/')[1] === 'doc'
                        "
                    >
                        <label for="select" class="secondary_color me-1"
                            >converti in
                        </label>
                        <select name="select" id="select" class="btn bg-select">
                            <option value="..." class="fw-bold">...</option>
                            <option value="doc">doc</option>
                            <option value="docx">docx</option>
                            <option value="jpg">jpg</option>
                            <option value="png">png</option>
                            <option value="html">html</option>
                        </select>
                    </div>

                    <div class="" v-else>
                        <strong class="text-danger"
                            >Seleziona un file pdf o doc per la conversione
                        </strong>
                    </div>

                    <span class="size_font">{{
                        formatFileSize(file.size)
                    }}</span>

                    <div class="remove-container">
                        <a
                            class="remove text-primary fw-bold"
                            v-on:click="removeFile(key)"
                            >X</a
                        >

                        <a
                            class="remove text-primary fw-bold"
                            id="donwloadButton"
                            >⬇️</a
                        >
                    </div>
                </div>
            </div>
            <div v-show="files >= files[0]">
                <div
                    class="mt-2 mb-2 bg-select container shadow d-flex justify-content-between align-items-center rounded remove_gutter_x"
                >
                    <div class="d-flex align-items-center">
                        <label
                            class="btn btn-default btn-file fw-bold d-flex align-items-center"
                        >
                            <span class="pe-2 text-primary fw-bold fs-4"
                                >+</span
                            >
                            Aggiungi file
                            <input
                                value="Convert file"
                                type="file"
                                name="File"
                                style="display: none"
                                ref="fileform3"
                            />
                        </label>
                        <p class="size_font m-0">
                            Utilizza Ctrl o Shift per selezionare <br />
                            più file contemporaneamente
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <label
                            class="btn btn-default btn-file fw-bold custom-icon-color"
                        >
                            <font-awesome-icon
                                icon="fa-solid fa-folder-plus "
                            />
                        </label>
                        <label
                            class="btn btn-default btn-file fw-bold custom-icon-color"
                        >
                            <font-awesome-icon icon="fa-brands fa-dropbox " />
                        </label>
                        <label
                            class="btn btn-default btn-file fw-bold custom-icon-color"
                        >
                            <font-awesome-icon
                                icon="fa-brands fa-google-drive "
                            />
                        </label>
                        <label
                            class="btn btn-default btn-file fw-bold custom-icon-color"
                        >
                            <font-awesome-icon icon="fa-solid fa-cloud " />
                        </label>
                        <label
                            class="btn fw-bold bg-convert text-white py-3 px-4"
                        >
                            CONVERTI
                            <font-awesome-icon
                                class="ps-1"
                                icon="fa-solid fa-arrow-right-long"
                            />
                            <input
                                class="btn"
                                type="submit"
                                @submit="apiCall"
                                value="Convert file"
                                style="display: none"
                            />
                        </label>
                    </div>
                </div>
            </div>
        </form>
        <!-- Seconda parte del sito contente la spiegazione di come funziona il programma -->
        <div class="second-section text-center mt-5 bg-white">
            <h2 class="fw-bold pt-5">Come funziona?</h2>
            <div class="container">
                <div class="row mt-5 d-flex justify-content-center">
                    <div class="col">
                        <img src="img/icona1.png" alt="" />
                        <h5 class="fw-bold my-4">
                            Carica il file da convertire
                        </h5>
                        <p>
                            Trascina il tuo file nel riquadro <br />
                            oppure caricalo dal dispositivo o da <br />
                            un cloud service.
                        </p>
                    </div>
                    <div class="col">
                        <img src="img/vector.png" class="pt-4" alt="" />
                    </div>
                    <div class="col">
                        <img src="img/icona2.png" alt="" />
                        <h5 class="fw-bold my-4">Seleziona il nuovo formato</h5>
                        <p>
                            Seleziona il nuovo formato del <br />
                            documento da convertire.
                        </p>
                    </div>
                    <div class="col">
                        <img src="img/vector.png" class="pt-4" alt="" />
                    </div>
                    <div class="col">
                        <img src="img/icona3.png" alt="" />
                        <h5 class="fw-bold my-4">
                            Scarica il tuo nuovo documento
                        </h5>
                        <p>
                            Clicca su "converti" e attendi <br />
                            qualche secondo prima che la <br />
                            conversione sia completata.
                        </p>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-primary px-4 py-2 text-white mt-5 mb-4"
                >Scopri i piani >
            </a>
        </div>
        <!-- terza parte del sito contenente i vantaggi del convertitore  -->
        <div class="third-serction text-center mt-5">
            <h2 class="fw-bold pt-5">I vantaggi di DOC CONVERTER</h2>
            <p class="mt-4">
                Doc Converter ti consente di convertire quasi tutti i tipi di
                file online da qualsiasi dispositivo. <br />
                Tutti i file vengono trasmessi attraverso una rete sicura ed i
                file vengono crittografati con AES 256.
            </p>

            <div class="container">
                <div class="row mt-5 mb-5 d-flex justify-content-center">
                    <div class="col-4 mb-5">
                        <font-awesome-icon
                            icon="fa-solid fa-rotate "
                            class="p-4 bg-white custom-color border border-0 rounded display-5 shadow"
                        />
                        <h5 class="fw-bold my-4">
                            Più di 300 formati supportati
                        </h5>
                        <p>
                            Supportiamo oltre 25600 conversioni differenti tra
                            più di 300 diversi formati di file.
                        </p>
                    </div>

                    <div class="col-4 mb-5">
                        <font-awesome-icon
                            icon="fa-regular fa-star"
                            class="p-4 bg-white custom-color border border-0 rounded display-5 shadow"
                        />
                        <h5 class="fw-bold my-4">Facile e veloce</h5>
                        <p>
                            Rilascia i tuoi file sulla pagina, scegli un formato
                            di output e fai clic sul pulsante "Converti".
                            Attendere un po' per il completamento del processo.
                            Miriamo a finire tutte le nostre conversioni in meno
                            di 1-2 minuti.
                        </p>
                    </div>

                    <div class="col-4 mb-5">
                        <font-awesome-icon
                            icon="fa-solid fa-cloud-arrow-up"
                            class="p-4 bg-white custom-color border border-0 rounded display-5 shadow"
                        />
                        <h5 class="fw-bold my-4">All’interno del cloud</h5>
                        <p>
                            Tutte le conversioni avvengono nel cloud e non
                            consumeranno alcuna risorsa del tuo computer.
                        </p>
                    </div>

                    <div class="col-4 mb-5">
                        <font-awesome-icon
                            icon="fa-solid fa-gear"
                            class="p-4 bg-white custom-color border border-0 rounded display-5 shadow"
                        />
                        <h5 class="fw-bold my-4">
                            Impostazioni personalizzate
                        </h5>
                        <p>
                            La maggior parte dei tipi di conversione supporta
                            opzioni avanzate. Ad esempio, con un convertitore
                            video è possibile scegliere qualità, rapporto
                            prospettico, codec e altre impostazioni, ruotare e
                            capovolgere.
                        </p>
                    </div>

                    <div class="col-4 mb-5">
                        <font-awesome-icon
                            icon="fa-solid fa-shield-virus"
                            class="p-4 bg-white custom-color border border-0 rounded display-5 shadow"
                        />
                        <h5 class="fw-bold my-4">Sicurezza garantita</h5>
                        <p>
                            I file caricati vengono cancellati immediatamente,
                            quelli convertiti vengono eliminati dopo 24 ore.
                            Nessuno ha accesso ai tuoi file e la privacy è
                            garantita al 100%.
                        </p>
                    </div>

                    <div class="col-4 mb-5">
                        <font-awesome-icon
                            icon="fa-solid fa-desktop"
                            class="p-4 bg-white custom-color border border-0 rounded display-5 shadow"
                        />
                        <h5 class="fw-bold my-4">
                            Tutti i dispositivi supportati
                        </h5>
                        <p>
                            Doc Converter è browser-based e funziona per tutte
                            le piattaforme. Non è necessario scaricare e
                            installare alcun software.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import ConvertApi from "convertapi-js";

export default {
    name: "App",

    /*
      Variables used by the drag and drop component
    */
    data() {
        return {
            dragAndDropCapable: false,
            files: [],
            uploadPercentage: 0,
        };
    },

    mounted() {
        /*
        Determine if drag and drop functionality is capable in the browser
      */
        this.dragAndDropCapable = this.determineDragAndDropCapable();

        /*
        If drag and drop capable, then we continue to bind events to our elements.
      */
        if (this.dragAndDropCapable) {
            /*
          Listen to all of the drag events and bind an event listener to each
          for the fileform.
        */
            [
                "change",
                "drag",
                "dragstart",
                "dragend",
                "dragover",
                "dragenter",
                "dragleave",
                "drop",
            ].forEach(
                function (evt) {
                    /*
            For each event add an event listener that prevents the default action
            (opening the file in the browser) and stop the propagation of the event (so
            no other elements open the file in the browser)
          */
                    this.$refs.fileform.addEventListener(
                        evt,
                        function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                        }.bind(this),
                        false
                    );

                    this.$refs.fileform2.addEventListener(
                        evt,
                        function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                        }.bind(this),
                        false
                    );

                    this.$refs.fileform3.addEventListener(
                        evt,
                        function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                        }.bind(this),
                        false
                    );
                }.bind(this)
            );

            /*
          Add an event listener for drop to the form
        */
            this.$refs.fileform.addEventListener(
                "drop",

                function (e) {
                    /*
            Capture the files from the drop event and add them to our local files
            array.
          */
                    for (let i = 0; i < e.dataTransfer.files.length; i++) {
                        this.files.push(e.dataTransfer.files[i]);
                    }
                }.bind(this)
            );
            this.$refs.fileform2.addEventListener(
                "change",
                function () {
                    console.log(this.$refs.fileform2.files[0]);
                    this.files.push(this.$refs.fileform2.files[0]);
                }.bind(this)
            );
            this.$refs.fileform3.addEventListener(
                "change",
                function () {
                    console.log(this.$refs.fileform3.files[0]);
                    this.files.push(this.$refs.fileform3.files[0]);
                }.bind(this)
            );
        }
    },

    methods: {
        async apiCall() {
            for (let i = 0; i < this.files.length; i++) {
                let donwloadBtn = document.getElementById("donwloadButton");
                let convertApi = ConvertApi.auth("ltE5TH69gYyu4IKI");
                let userSelect = document.getElementById("select").value;
                let userFile = this.files[i].type.split("/")[1];
                let params = convertApi.createParams();
                params.add("File", this.files[0]);
                console.log(params);
                let result = await convertApi.convert(
                    userFile,
                    userSelect,
                    params
                );
                let url = result.files[i].Url;
                /* let url =
                    "https://v2.convertapi.com/convert/" +
                    userFile +
                    "/to/" +
                    userSelect +
                    "?Secret=ltE5TH69gYyu4IKI&Token=188598682&Storefile=true";
                console.log(url); */
                console.log(url);
                donwloadBtn.href = url;
                console.log(donwloadBtn);
            }
        },
        /*
        Determines if the drag and drop functionality is in the
        window
      */
        determineDragAndDropCapable() {
            /*
          Create a test element to see if certain events
          are present that let us do drag and drop.
        */
            var div = document.createElement("div");

            /*
          Check to see if the `draggable` event is in the element
          or the `ondragstart` and `ondrop` events are in the element. If
          they are, then we have what we need for dragging and dropping files.

          We also check to see if the window has `FormData` and `FileReader` objects
          present so we can do our AJAX uploading
        */
            return (
                ("draggable" in div ||
                    ("ondragstart" in div && "ondrop" in div)) &&
                "FormData" in window &&
                "FileReader" in window
            );
        },

        /*
        Removes a select file the user has uploaded
      */
        removeFile(key) {
            this.files.splice(key, 1);
        },

        formatFileSize(bytes) {
            const sufixes = ["B", "kB", "MB", "GB", "TB"];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));
            return `${(bytes / Math.pow(1024, i)).toFixed(2)} ${sufixes[i]}`;
        },
    },
};
</script>

<style lang="scss" scoped>
.custom-color {
    color: #2a67eb;
}
.custom-icon-color {
    color: #9ebbfa;
    &:hover {
        color: #2a67eb;
    }
}

/* stat form  */

p {
    color: #818498;
}

h2 {
    color: #1f0f4d;
}

h5 {
    color: #040b38;
}
.first-section {
    width: 100%;
    background-color: #fafcff;
    background-image: url("/img/background-main.png");
    h1 {
        font-size: 64px;
        color: #040b38;
    }
    .border-dashed {
        border-style: dashed;
    }
    .bg-lightblue {
        background-color: #e4ecfc;
    }
}

div.file-listing {
    margin: auto;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

div.remove-container a {
    text-decoration: none;
    cursor: pointer;
}

progress {
    width: 400px;
    margin: auto;
    display: block;
    margin-top: 20px;
    margin-bottom: 20px;
}

/* ^ end form */
.secondary_color {
    color: #818498;
}

.size_font {
    font-size: 12px;
    color: #818498;
}

.bg-select {
    background-color: #e4ecfc;
}
.border-custom {
    border: 1px solid #e4ecfc;
}

.bg-convert {
    background-color: #9ebbfa;
}

.remove_gutter_x {
    --bs-gutter-x: 0;
}
</style>
