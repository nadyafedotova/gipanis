<template>
    <div>
        <form method="POST"  enctype="multipart/form-data" id="generate">
            <label for="send-to-amazon">
                <input type="checkbox" name="send_to_amazon" id="send-to-amazon" v-mode=""/>
                Only that need to be sent to Amazon
            </label>
            <label for="without-in">
                <input type="checkbox" name="without_in" id="without-in" />
                Without product in Stuecklisten
            </label>
            <label for="ama-logik">
                <input type="checkbox" name="ama_logik" id="ama-logik"/>
                AMA-Logik
            </label>
            <label for="hide">
                <input type="checkbox" name="hide" id="hide" >
                Hide Columns
            </label>
            <br/>
            <button type="button" class="btn btn-info" @click="onButtonClick">Export</button>
        </form>

    </div>
</template>

<script>
    import Vue from 'vue'
    import { mapState, mapActions, mapGetters } from 'vuex'

    //    Vue.component('filter-bar', AmzFilterBar)
    export default {
        name: 'ExportForm',
        components: {
        },
        props: {
            tableUri: String
        },

        methods: {
            onButtonClick(e) {
                this.$store.dispatch('complexReports/amzCalculator/doExport');
            },

        },
        computed: {
            ...mapGetters('complexReports/amzCalculator', ['getExportFields'])
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