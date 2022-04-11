<template>
  <div>
    <nci-input
      :value="search"
      type="text"
      :placeholder="$t('bt.search')"
      @update:value="updateSearch"
    />
    <nci-settings-tree
      :pathItems="pathItemsFiltered"
      @select:key="displayParams"
    />

    <div v-for="param in listParams" :key="param.code">
      <nci-settings :setting="param" />
    </div>
  </div>
</template>

<script>
import { NciInput } from "@/components/ui/NciUI";
import { NciSettingsTree } from "@/components/NciSettings";
import { NInput } from "naive-ui";
import { mapState } from "pinia";
import { useSettings } from "@/business/stores/useSettings";
import NciSettings from "../components/NciSettings.vue";

export default {
  components: {
    NInput,
    NciInput,
    NciSettingsTree,
    NciSettings,
  },

  computed: {
    ...mapState(useSettings, {
      pathItems: "settingsPath",
      loadParams: "listParams",
    }),

    pathItemsFiltered() {
      var rAry = [];
      this.pathItems.forEach((item) => this.getItem(item, rAry));
      return rAry;
    },
  },

  methods: {
    updateSearch(text) {
      this.search = text;
    },

    displayParams(key) {
      this.listParams = this.loadParams(key);
    },

    getItem(item, ary) {
      let found = item.key.toLowerCase().includes(this.search.toLowerCase());
      if (found) ary.push(item);
      if (!found && item.children) {
        item.children.forEach((toto) => this.getItem(toto, ary));
      }
    },
  },

  data() {
    return {
      search    : "",
      listParams: [],
    };
  },
};
</script>


<style lang="scss" scoped>
.n-tree {
  width: 15%;
}
</style>