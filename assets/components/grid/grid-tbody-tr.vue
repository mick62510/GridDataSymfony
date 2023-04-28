<template>
  <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500" v-for="array in dataClass.getData()">
    <td class="whitespace-nowrap px-4 py-3 sm:px-5" v-for="(value,indexTd) in array"
        v-show="showTr(indexTd)">
      <span>{{ value }}</span>
    </td>
    <td v-if="array.actions">
      <div class="content-start justify-center flex">
        <div class="flex justify-center space-x-2">
          <button type="button" v-for="(url,actionName) in array.actions" @click="redirect(url)"
                  :class="getClassBtn(actionName)" class="btn h-8 w-8 p-0" v-html="getBtnIcon(actionName)">
          </button>
        </div>
      </div>
    </td>
  </tr>
</template>

<script>
import DataClass from "./classes/data";
import ConfigClass from "./classes/config";

export default {
  name: "grid-tbody-tr",
  props: {
    dataClass: {type: DataClass},
    configClass: {type: ConfigClass},
  },
  data() {
    return {
      line: 0,
    }
  },
  methods: {
    getBtnIcon: function (actionName) {
      return this.configClass.getColumnAction(actionName).getIcon();
    },
    showTr: function (columnIndex) {
      if (columnIndex === 'actions') {
        return false;
      }

      let column = this.configClass.getColumn(columnIndex);
      return column ? !column.isHidden() && column.isDefault() : false;
    },
    redirect: function (url) {
      window.location.href = url;
    },
    getClassBtn(actionName) {
      let colors = {
        'primary': ["text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25"],
        'secondary': ["text-secondary hover:bg-secondary/20 focus:bg-secondary/20 active:bg-secondary/25"],
        'danger': ["text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25"],
        'edit': ['text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25'],
      };
      let color = this.configClass.getColumnAction(actionName).getColor();

      return colors.hasOwnProperty(color) ? colors[color] : [];
    },
  }
}
</script>

<style scoped>

</style>
