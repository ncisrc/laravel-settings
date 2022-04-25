<template>
  <div>
    <div class="flex mt-5">
      <div class="w-4/6 ml-5">
        <InputText
        class="w-full"
          v-model="filter"
          :placeholder="$t('bt.filter')"
          @keyup="updateFilter"
        />
      </div>
      <div class="w-2/6 ml-3 pr-5">
        <nci-select
          class="w-full"
          v-if="settingType == 'U'"
          v-model="select"
          placeholder="Choix de l'utilisateur"
        />
      </div>
    </div>

    <div class="flex">
      <div class="w-1/6 mt-5 ml-5">
        <Tree
          :value="filteredSettingsPaths"
          :expandedKeys="expandedKeys"
        ></Tree>
      </div>
      <div class="w-3/6 ml-5">
        <div
          class="border border-current p-5 my-5 mr-2"
          v-for="setting in filteredSettings"
          :key="setting.id"
        >
          <nci-settings :setting="setting" />
        </div>
      </div>
      <div class="w-2/6 ml-3"></div>
    </div>
  </div>
</template>

<script>
import { useSettings } from "@/business/stores/useSettings";
import NciSettings from "../components/NciSettings.vue";
import { NciSelect } from "@/components/ui/NciUI";
import InputText from "primevue/inputtext";
import Tree from "primevue/tree";

export default {
  components: {
    InputText,
    NciSettings,
    NciSelect,
    Tree,
  },

  props: {
    settingType: String,
  },

  watch: {
    filteredSettingsPaths() {
      for (let node of this.filteredSettingsPaths) {
        this.expandNode(node);
      }
    },
  },

  data() {
    return {
      filter: "",
      select: null,
      nodes: null,
      expandedKeys: {},
    };
  },

  setup() {
    const useSettingsStore = useSettings();
    return {
      useSettingsStore,
    };
  },

  computed: {
    filteredSettings() {
      return this.settingType == "A"
        ? this.useSettingsStore.applicationSettingsFiltered
        : this.useSettingsStore.userSettingsFiltered;
    },

    filteredSettingsPaths() {
      return this.settingType == "A"
        ? this.useSettingsStore.applicationSettingsPaths
        : this.useSettingsStore.userSettingsPaths;
    },
  },

  methods: {
    updateFilter() {
      this.useSettingsStore.setFilter(this.filter);
    },

    expandNode(node) {
      if (node.children && node.children.length) {
        this.expandedKeys[node.key] = true;
        for (let child of node.children) {
          this.expandNode(child);
        }
      }
    },
  },
};
</script>
