import FilterSelector from './components/FilterSelector';
import ColumnFilter from './components/ColumnFilter';

Nova.booting((Vue, router) => {
    Vue.component('column-filter', ColumnFilter);
    Vue.component('filter-selector', FilterSelector);
});