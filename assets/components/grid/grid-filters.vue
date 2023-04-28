<template>
  <div class='flex items-center justify-center mt-5'>
    <div class="border p-2 w-11/12">
      <div class="w-full items-center border-b pb-2">
        <div class="text-sm font-bold text-slate-700">Recherche avancée</div>
      </div>
      <div>
        <div class="grid grid-cols-4 mt-3">
          <span v-for="(filter,filterId) in filters" class="text-center grid-cols-2">
            <div>
              <span v-if="filter.type === 'select'">
                  <grid-filters-select :options="filter.options" :select-id="filterId"
                                       @change="selectChange($event)"
                                       :title="filter.title">
                  </grid-filters-select>
              </span>
              <span v-else-if="filter.type === 'input'">
                  <grid-filters-input></grid-filters-input>
              </span>
            </div>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import GridFiltersSelect from "./grid-filters-select";
import GridFiltersInput from "./grid-filters-input";

export default {
  name: "grid-filters",
  components: {GridFiltersInput, GridFiltersSelect},
  props: {
    filters: {type: Object, default: {}},
  },
  data() {
    return {}
  },
  methods: {
    selectChange(event) {
      let value = event.target.value;
      let idSelect = event.target.id;

      this.$emit('update', idSelect, value);
    },
  },
}
</script>

<style scoped>

</style>
