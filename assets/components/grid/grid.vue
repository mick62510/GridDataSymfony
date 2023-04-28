<template>
  <div>
    <div class="card">
      <grid-filters :filters="configClass.getFilters()" @update="updateFilter"
                    v-if="configClass.hasFilters()"></grid-filters>
      <div class="grid grid-flow-row-dense grid-cols-2 grid-rows-1 mt-5 mb-2">
        <grid-display-column :columns="configClass.getColumns()"
                             @update="updateColumnDefaultValue"></grid-display-column>
        <grid-search @update="updateGlobalSearch"></grid-search>
      </div>
      <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
        <table class="is-hoverable w-full text-left">
          <grid-thead-tr :columns="configClass.getColumns()" @update="updateOrderBy"
                         :has-column-actions="this.configClass.hasAction()">
          </grid-thead-tr>
          <tbody>
          <grid-tbody-tr :data-class="dataClass" :config-class="configClass"></grid-tbody-tr>
          </tbody>
        </table>
      </div>
      <grid-footer :page="dataClass.getPage()"
                   :total-pages="dataClass.getTotalPages()" :count="dataClass.getCount()"></grid-footer>
    </div>
    <action-bar :actions="actionsBar" v-if="actionsBar"></action-bar>
  </div>
</template>

<script>
import GridTbodyTr from "./grid-tbody-tr";
import GridTheadTr from "./grid-thead-tr";
import axios from "axios";
import GridFooter from "./grid-footer";
import GridSearch from "./grid-search";
import GridFilters from "./grid-filters";
import GridDisplayColumn from "./grid-display-column";
import DataClass from './classes/data'
import ConfigFactory from "./classes/configFactory";
import Config from "./classes/config";
import ActionBar from "../tools/actionBar";

export default {
  name: "grid",
  components: {ActionBar, GridDisplayColumn, GridFilters, GridSearch, GridFooter, GridTbodyTr, GridTheadTr},
  props: {
    config: {type: Object},
    routeAjax: {type: String},
    actionsBar: {type: Object, default: {}}
  },
  data() {
    return {
      dataClass: new DataClass([], 0, 0, 1),
      configClass: {type: Config},
      globalSearch: '',
      orderBy: {},
      filtersValues: {},
    }
  },
  methods: {
    execRequest: function (url, params = {}) {
      axios.get(url, {params: params})
          .then((response) => {
            let data = response.data;
            this.dataClass = new DataClass(data.values, data.totalPages, parseInt(data.pageToShow), data.count)
          })
    },
    loadPage: function (page) {
      this.execRequest(this.routeAjax, {
        page: page,
        search: this.globalSearch,
        filters: this.filtersValues,
        orderBy: this.orderBy,
      })
    },
    changePage: function (page) {
      //TODO utilisé dans footer dégoulasse ! à changer
      this.loadPage(page);
    },
    updateColumnDefaultValue(index) {
      this.configClass.updateColumnDefaultValue(index);
    },
    updateFilter(idFilter, value) {
      if (idFilter in this.filtersValues) {
        delete this.filtersValues[idFilter];
      }

      if (value) {
        this.filtersValues[idFilter] = value;
      }

      this.loadPage(1);
    },
    updateGlobalSearch(value) {
      this.globalSearch = value;
      this.loadPage(1);
    },
    updateOrderBy(field, orderByType) {
      if (field in this.orderBy) {
        delete this.orderBy[field];
      }

      if (orderByType) {
        this.orderBy[field] = orderByType;
      }

      this.loadPage(1);
    },
  },
  created() {
    this.configClass = new ConfigFactory(this.config);
    this.loadPage(1);
  },
}
</script>

<style scoped>

</style>
