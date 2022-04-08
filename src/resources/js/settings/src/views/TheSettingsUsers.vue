<template>
  <div>
    <div class="TheSettingsUsers">
      <nci-input
        v-model:value="search"
        type="text"
        placeholder="search"
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
  </div>
</template>

<script>
import { NciInput, NciSelect } from "@/components/ui/NciUI";

import { NciSettingsTree } from "@/components/NciSettings";

import { mapState } from "pinia";
import { useSettings } from "@/business/stores/useSettings";

export default {
  components: {
    NciInput,
    NciSelect,
    NciSettingsTree,
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
      search: "",
      select: null,
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