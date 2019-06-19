<template>
    <div>
        <label class="form-label">{{label}}</label>
        <div v-for="(item, key) in values" class="form-check mb-2 mr-sm-2">
            <input v-model="radioValue"
                   type="radio" :id="'radio-'+name+'-'+key" :value="item.key" :name="name" @change="handleChange">
            <label :for="'radio-'+name+'-'+key">{{item.label}}</label>
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
            computed: {
                radioValue: {
                    get() {
                        return this.value;
                    },
                    set(val) {
                        this.handleRadio(val);
                    },
                }
            },
            methods: {
                handleChange(e) {
                    console.log('handleChange', e);
                    this.$emit('change', e.target.value);
                },
                handleRadio(val) {
                    this.$emit('input', val);
                }
            }
        }
    </script>
</template>