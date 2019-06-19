<template>
    <div>
        <form method="POST"  enctype="multipart/form-data" id="generate">
                <input type="file" name="template_file" id="file-1" class="inputfile inputfile-1" />
                <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>
                    <span>Upload txt from Amazon&hellip;</span>
                </label>
                <br/>
                <p v-if="hasTemplateFile" class="text-muted">{{getTemplateFileName}}</p>
        </form>
        <h5>Generating a file with products for import into Amazon</h5>
        <button type="button" class="btn btn-info" @click="onButtonClick">Download CSV For Amazon</button>
    </div>
</template>

<script>
    import Vue from 'vue'
    import { mapState, mapActions, mapGetters } from 'vuex'

    //    Vue.component('filter-bar', AmzFilterBar)
    export default {
        name: 'AmzImportTable',
        components: {
        },
        props: {
            tableUri: String
        },
        mounted() {
            this.$store.dispatch('complexReports/amzImport/getTemplate')
        },
        methods: {
            onButtonClick(e) {
                this.$store.dispatch('complexReports/amzImport/doCreate');
            },

            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    return;

                }
                console.log('File', files);
                this.$store.dispatch('complexReports/amzImport/doStore', files[0]);
            }
        },
        computed: {
            ...mapGetters('complexReports/amzImport', ['hasTemplateFile', 'getTemplateFileName'])
        }

    }
</script>

<style>
    .inputfile {
        /* width: 0.1px; */
        /* height: 0.1px; */
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .inputfile-1 + label {
        color: #f1e5e6;
        background-color: #d3394c;
    }
    .inputfile + label {
        max-width: 80%;
        font-size: 1.25rem;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        padding: 0.625rem 1.25rem;
    }
    .inputfile + label svg {
        width: 1em;
        height: 1em;
        vertical-align: middle;
        fill: currentColor;
        margin-top: -0.25em;
        margin-right: 0.25em;
    }

    .inputfile + label * {
        /* pointer-events: none; */
    }
    svg:not(:root) {
        overflow: hidden;
    }
</style>