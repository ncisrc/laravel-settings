<template>
  <div>
    <div>
      <input
        v-model="filter"
        type="text"
        :placeholder="$t('bt.filter')"
      />
    </div>

    <div class="flex">
      <div class="w-1/4">
        <n-tree
            block-line
            :data="filteredPaths"
            selectable
          />
      </div>
      <div class="w-3/4">
        <div v-for="setting in filteredSettings" :key="setting.id">
          <nci-settings :setting="setting" />
          <hr />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapStores } from "pinia";
import { useSettings } from "@/business/stores/useSettings";
import { NTree } from "naive-ui";
import stringToPath from "../libs/stringToPath";
import NciSettings from "../components/NciSettings.vue";

export default {
  setup() {
    return { stringToPath };
  },
  components: {
    NTree,
    NciSettings,
  },

  data() {
    return {
      filter: "",
    };
  },

  computed: {
    ...mapStores(useSettings),

    filteredSettings() {
      if (this.useSettingsStore.applicationSettings.length == 0)
        return [];

      if (this.filter == '')
        return this.useSettingsStore.applicationSettings;

      return this.useSettingsStore.applicationSettings.filter(item => {
        return item.matchFilter(this.filter)
      });
    },

    filteredPaths() {
      return this.stringToPath(this.filteredSettings);
    },
  },
};
</script>
