<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
            {{ filter.name }}
        </h3>
        <div class="flex p-2">
            <select
                    :dusk="filter.name + '-column-filter-select'"
                    class="block w-full form-control-sm form-select mr-2"
                    @change="handleChange"
                    v-model="column">
                <option value="">&mdash;</option>
                <option
                        v-for="(value, key) in this.getOption('columns')"
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
                        v-for="(value, key) in this.getOption('operators')"
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
            },
            resourceName: {
                type: String,
                required: true,
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
            this.column = this.value.column || ''
            this.operator = this.value.operator || ''
            this.data = this.value.data || ''
        },
        methods: {
            handleChange : function (event){
                let newValue = {
                    column : this.column,
                    operator : this.operator,
                    data : this.data
                }
                if(! this.column || ! this.operator || ! this.data)
                    newValue = ""

                let shouldRaise = newValue !== this.value;

                this.$store.commit(`${this.resourceName}/updateFilterState`, {
                    filterClass: this.filterKey,
                    value: newValue
                });

                this.shouldRaise && this.$emit('change');
            },

            getOption(name){
                let key = _.findKey(this.options, (o) => o.name === name)

                if(key)
                    return this.options[key].value;
                
                let obj = _.find(this.options, (o) => o.value === name)

                if(obj)
                    return _.omit(obj, 'value');

                return null;
            }
        },
        computed: {
            filter() {
                return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey)
            },
            value() {
                return this.filter.currentValue;
            },
            options() {
                return this.$store.getters[`${this.resourceName}/getOptionsForFilter`](this.filterKey)
            }
        }
    }

</script>


<style>

</style>
