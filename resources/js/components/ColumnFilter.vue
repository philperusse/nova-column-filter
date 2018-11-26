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
                    v-model="currentValue.column">
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
                    v-model="currentValue.operator"
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
                   v-model="currentValue.data"
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
                currentValue : {
                    column : '',
                    operator : '',
                    data : ''
                }
            }
        },
        mounted() {
            this.currentValue = this.value
        },
        methods: {
            handleChange : function (event){
                if(! this.currentValue.column || !this.currentValue.operator || !this.currentValue.data)
                    return;

                this.$store.commit('updateFilterState', {
                    filterClass: this.filterKey,
                    value: this.currentValue,
                });

                this.$emit('change');
            },
            getOption(name){
                let key = _.findKey(this.options, (o) => o.name === name)
                if(! key)
                    return null;

                return this.options[key].value
            }
        },
        computed: {
            filter() {
                return this.$store.getters.getFilter(this.filterKey)
            },
            value() {
                return this.filter.currentValue;
            },
            options() {
                return this.$store.getters.getOptionsForFilter(this.filterKey)
            }
        }
    }

</script>


<style>

</style>