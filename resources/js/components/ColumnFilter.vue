<template>
    <div class="flex">
        <select
                :dusk="filter.name + '-column-filter-select'"
                class="block w-full form-control-sm form-select mr-2"
                v-model="column"
                @change="filterChange">
            <option
                    value=""
                    selected
            >&mdash;</option>
            <option
                    v-for="(value, key) in filter.options.columns"
                    :key="key"
                    :value="key"
                    v-html="value"
            >
            </option>
        </select>
        <select
                :dusk="filter.name + '-operator-filter-select'"
                class="block w-full form-control-sm form-select mr-2"
                v-model="operator"
                @change="filterChange"
        >
            <option
                    value=""
                    selected
            >&mdash;</option>
            <option
                    v-for="(value, key) in filter.options.operators"
                    :key="key"
                    :value="key"
                    v-html="value"
            >

            </option>
        </select>

        <input type="text"
               v-model="data"
               class="block w-full form-control-sm form-input form-input-bordered"
               @change="filterChange"
        >

    </div>
</template>


<script>

    export default {
        props: {
            value : {
                type: [String, Object],
                default : () =>  ({
                    column : '',
                    operator : '',
                    data : ''
                })
            },
            filter: {
                type: Object,
                default: () => ({})
            },
        },
        data() {
            return {
                column : '',
                operator : '',
                data : ''
            }
        },
        mounted() {
            this.column = this.value.column || '';
            this.operator = this.value.operator || '';
            this.data = this.value.data || '';
        },
        methods: {
            filterChange : function (){

                if(this.column && this.operator && this.data)
                    return this.$emit('input', this.$data)

                this.$emit('input',  {
                    'column' : '',
                    'operator' : '',
                    'data' : ''
                });
            }
        }
    }

</script>


<style>

</style>