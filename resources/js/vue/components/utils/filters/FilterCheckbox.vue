<template>
    <div>
        <label>{{label}}</label>
        <div v-for="(item, key) in values" class="form-check mb-2 mr-sm-2">
            <input type="checkbox" :id="'checkbox-'+key" :value="item.key" :name="name" @input="handleCheckbox">
            <label :for="'checkbox-'+key">{{item.label}}</label>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            values: {},
            value: null,
            name: null,
            label: null
        },
        data () {
            return {

            }
        },
        methods: {
            handleCheckbox() {

            }
        }
    }
</script>