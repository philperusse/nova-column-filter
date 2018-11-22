<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
            {{ filter.name }}
        </h3>
        <div class="flex p-2">
            <select
                    :dusk="filter.name + '-column-filter-select'"
                    class="block w-full form-control-sm form-select mr-2"
                    v-model="column"
                    @change="handleChange">
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
                    @change="handleChange"
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
                   @change="handleChange"
            >

        </div>
    </div>

</template>


<script>

    export default {
        props: {
            filterKey: {
                type: String,
                required: true,
            }
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
            handleChange : function (){
                let newValue = {
                    'column' : '',
                    'operator' : '',
                    'data' : ''
                };

                if(this.column && this.operator && this.data)
                    newValue  = this.$data;

                this.$store.commit('updateFilterState', {
                    filterClass: this.filterKey,
                    value: newValue,
                });

                this.$emit('change');
            }
        },
        computed: {
            filter() {
                return this.$store.getters.getFilter(this.filterKey)
            },

            value() {
                return this.filter.currentValue
            },
        }
    }

</script>


<style>

</style>