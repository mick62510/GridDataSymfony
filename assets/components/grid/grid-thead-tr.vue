<template>
  <thead>
  <tr>
    <th data-column-id="total"
        class="gridjs-th gridjs-th-sort px-3 py-3  bg-slate-200 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
        v-for="(column,index) in columns" v-show="!column.isHidden() && column.isDefault()">
      <div class="gridjs-th-content">{{ column.getTitle() }}</div>
      <button tabindex="-1" aria-label="Sort column ascending" title="Sort column ascending"
              v-on:click="execOrderBy(index)"
              class="gridjs-sort z-0" :class="orderByAscClass(index)"></button>
    </th>
    <th v-if="hasColumnActions" scope="col"
        class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"></th>
  </tr>
  </thead>
</template>

<script>
export default {
  name: "grid-thead-tr",
  props: {
    columns: {type: Object},
    hasColumnActions: {type: Boolean}
  },
  data() {
    return {
      orderByType: {type: String, default: 'ASC'},
      orderById: {type: String},
    }
  },
  methods: {
    execOrderBy: function (newOrderById) {

      if (newOrderById !== this.orderById || !this.orderByType) {
        this.orderByType = 'ASC';
      } else {
        this.orderByType = this.orderByType === 'ASC' ? 'DESC' : '';
      }

      this.$emit('update', newOrderById, this.orderByType);

      this.orderById = newOrderById;
    },
    orderByAscClass: function (newOrderBy) {
      if (this.orderById === newOrderBy && this.orderByType === 'ASC') {
        return ['gridjs-sort-asc']
      } else if (this.orderById === newOrderBy && this.orderByType === 'DESC') {
        return ['gridjs-sort-desc']
      } else {
        return ['gridjs-sort-neutral'];
      }
    },
  },
}
</script>

<style scoped>

</style>
