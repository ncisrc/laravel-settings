<template>
  <div>
    <div class="flex">
      <div class="w-full ml-4">
        <input
          v-model="filter"
          type="text"
          :placeholder="$t('bt.filter')"
          @keyup="updateFilter"
        />
      </div>
      <div class="w-1/4 mr-4">
        <nci-select
          v-if="settingType=='U'"
          v-model="select"
          placeholder="Choix de l'utilisateur"
          class="nciSelect"
        />
      </div>
    </div>

    <div class="flex">
      <div class="w-1/4">
        <n-tree
            block-line
            :data="filteredSettingsPaths"
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
import NciSettings from "../components/NciSettings.vue";
import { NciSelect } from "@/components/ui/NciUI";

export default {
  components: {
    NTree,
    NciSettings,
    NciSelect,
  },

  props: {
    settingType: String,
  },

  data() {
    return {
      filter: "",
      select: null,
    };
  },

  computed: {
    ...mapStores(useSettings),

    filteredSettings() {
      return this.settingType == "A" ? this.useSettingsStore.applicationSettingsFiltered : this.useSettingsStore.userSettingsFiltered;
    },

    filteredSettingsPaths() {
      return this.settingType == "A" ? this.useSettingsStore.applicationSettingsPaths : this.useSettingsStore.userSettingsPaths;
    },
  },

  methods:{
    updateFilter(){
      this.useSettingsStore.setFilter(this.filter);
    }
  }
};
</script>
