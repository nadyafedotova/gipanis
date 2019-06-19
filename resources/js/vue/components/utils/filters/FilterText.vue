<template>
    <div>
        <label>{{label}}</label>
        <input @input="handleInput" @blur="handleBlur" @focus="handleFocus" type="text" :name="name" :value="value"/>
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
        methods: {
            handleBlur() {
                this.$emit('blur');
            },
            handleFocus() {
                this.$emit('focus');
            },
            handleInput(e) {
                this.$emit('input', e.target.value);
            }
        }
    }
</script>