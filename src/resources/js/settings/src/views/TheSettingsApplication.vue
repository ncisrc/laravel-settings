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
      <nci-settings :setting="param"/>
    </div>
  </div>

</template>

<script>
import { NciInput } from "@/components/ui/NciUI";
import { NciSettingsTree, NciSettingsInput } from "@/components/NciSettings";
import { mapState } from "pinia";
import { useSettings } from "@/business/stores/useSettings";
import NciSettings from "../components/NciSettings.vue";

export default {
  components: {
    NciSettingsInput,
    NciInput,
    NciSettingsTree,
    NciSettings,
  },

  mounted() {
    this.listParams = this.loadAllParams();
    console.log(this.listParams)
  },

  computed: {
    ...mapState(useSettings, {
      pathItems: "settingsPath",
      loadParams: "listParams",
      loadAllParams: "loadAll",
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
      console.log(this.loadAllSettingsParams());
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

    loadAllSettingsParams() {
      this.listParams = this.loadAllParams();
      this.listParams = this.listParams.filter(params => {
        return params.text.toLowerCase().includes(this.search.toLowerCase()) || params.label.toLowerCase().includes(this.search.toLowerCase())
      })
    }
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