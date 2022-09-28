<template>
    <form
        class="first-section text-center mt-5 mb-5"
        method="get"
        enctype="multipart/form-data"
        @submit.prevent="apiCall"
    >
        <h1 class="fw-bold">Convertitore file</h1>
        <p>
            Converti file, documenti, immagini, video, audio, siti web e altro
            ancora in qualsiasi formato.
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
                            id="file"
                            value="Convert file"
                            type="file"
                            name="File"
                            style="display: none"
                            ref="fileform2"
                            accept=".pdf, .doc"
                        />
                    </label>

                    <label
                        class="btn btn-default btn-file fw-bold custom-icon-color"
                    >
                        <font-awesome-icon icon="fa-solid fa-folder-plus " />
                    </label>
                    <label
                        class="btn btn-default btn-file fw-bold custom-icon-color"
                    >
                        <font-awesome-icon icon="fa-brands fa-dropbox " />
                    </label>
                    <label
                        class="btn btn-default btn-file fw-bold custom-icon-color"
                    >
                        <font-awesome-icon icon="fa-brands fa-google-drive " />
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
                    <select
                        name="select"
                        :id="key + file.name"
                        class="btn bg-select"
                    >
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

                <span class="size_font">{{ formatFileSize(file.size) }}</span>

                <div class="remove-container">
                    <a
                        v-show="fileUrl"
                        class="remove text-primary fw-bold"
                        href="#"
                        :id="file.name"
                        ><font-awesome-icon icon="fa-solid fa-download"
                    /></a>
                    <a
                        v-show="!fileUrl"
                        class="remove text-primary fw-bold"
                        v-on:click="removeFile(key)"
                        >X</a
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
                        <span class="pe-2 text-primary fw-bold fs-4">+</span>
                        Aggiungi file
                        <input
                            id="file"
                            value="Convert file"
                            type="file"
                            name="File"
                            style="display: none"
                            ref="fileform3"
                            accept=".pdf, .doc"
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
                        <font-awesome-icon icon="fa-solid fa-folder-plus " />
                    </label>
                    <label
                        class="btn btn-default btn-file fw-bold custom-icon-color"
                    >
                        <font-awesome-icon icon="fa-brands fa-dropbox " />
                    </label>
                    <label
                        class="btn btn-default btn-file fw-bold custom-icon-color"
                    >
                        <font-awesome-icon icon="fa-brands fa-google-drive " />
                    </label>
                    <label
                        class="btn btn-default btn-file fw-bold custom-icon-color"
                    >
                        <font-awesome-icon icon="fa-solid fa-cloud " />
                    </label>
                    <label class="btn fw-bold bg-convert text-white py-3 px-4">
                        CONVERTI
                        <font-awesome-icon
                            class="ps-1"
                            icon="fa-solid fa-arrow-right-long"
                        />
                        <input
                            class="btn"
                            type="submit"
                            id="upload-btn"
                            @submit="apiCall"
                            value="Convert file"
                            style="display: none"
                        />
                    </label>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import ConvertApi from "convertapi-js";
export default {
    name: "FirstmainComponent",

    data() {
        return {
            dragAndDropCapable: false,
            files: [],
            uploadPercentage: 0,
            fileUrl: false,
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
                    /* console.log(this.$refs.fileform2.files[0]); */
                    this.files.push(this.$refs.fileform2.files[0]);
                }.bind(this)
            );
            this.$refs.fileform3.addEventListener(
                "change",
                function () {
                    /* console.log(this.$refs.fileform3.files[0]); */
                    this.files.push(this.$refs.fileform3.files[0]);
                }.bind(this)
            );
        }
    },

    methods: {
        async apiCall() {
            for (let i = 0; i < this.files.length; i++) {
                let donwloadBtn = document.getElementById(this.files[i].name);
                let convertApi = ConvertApi.auth("ltE5TH69gYyu4IKI");
                let userSelect = document.getElementById(
                    i + this.files[i].name
                ).value;
                let userFile = this.files[i].type.split("/")[1];
                let params = convertApi.createParams();
                params.add("File", this.files[i]);
                /*   console.log(params); */
                let result = await convertApi.convert(
                    userFile,
                    userSelect,
                    params
                );
                /*    console.log(result); */
                let url = result.files[0].Url;
                /*
                    console.log(url); */
                donwloadBtn.href = url;
                this.fileUrl = true;

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
@import "resources/sass/FirstMainStyle.scss";
</style>
