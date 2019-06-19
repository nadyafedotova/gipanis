<template>
	<div>
		<label>{{label}}</label>
		<select @input="handleSelect" @change="handleChange" :value="value" :name="name" class="form-control mx-sm-3">
			<option v-for="(opt, i) in values" :key="i" :value="opt.key">
				{{ opt.label }}
			</option>
		</select>
	</div>
</template>

<script>
	export default {
	    name: 'FilterSelect',
        props: {
            values: {
                type: Array,
				default: () => ([]),
			},
            value: {
                type: [String, Number],
				default: null,
			},
            name: String,
            label: String
        },
		methods: {
            handleChange(e) {
                this.$emit('change', e.target.value);
			},
            handleSelect(e) {
                this.$emit('input', e.target.value);
			}
		}
	}
</script>