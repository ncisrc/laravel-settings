<template>
  <div>
    <div class="TheSettingsUsers">
      <nci-input
        v-model:value="search"
        type="text"
        placeholder="search"
        @update:value="updateSearch"
        class="nciInput"
      />
      <nci-select
        v-model:value="select"
        placeholder="Choix de l'utilisateur"
        class="nciSelect"
      />
    </div>
    <div>
      <nci-settings-tree
        :pathItems="pathItemsFiltered"
        @select:key="displayParams"
        class="nciTree"
      />
    </div>
    <div v-for="param in listParams" :key="param.code">
      <nci-settings :setting="param" />
    </div>
  </div>
</template>

<script>
import { NciInput, NciSelect } from "@/components/ui/NciUI";

import { NciSettingsTree } from "@/components/NciSettings";

import { mapState } from "pinia";
import { useSettings } from "@/business/stores/useSettings";
import NciSettings from "../components/NciSettings.vue";

export default {
  components: {
    NciInput,
    NciSelect,
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
      select    : null,
      listParams: [],
    };
  },
};
</script>

<style lang="scss" scoped>
.TheSettingsUsers {
  display: flex;
}

.n-input {
  margin-right: 2rem;
}

.n-tree {
  width: 15%;
}
</style>