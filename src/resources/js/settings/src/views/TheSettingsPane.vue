<template>
  <div>
    <div class="flex mt-5">
      <div class="w-4/6 ml-5">
        <InputText
        class="w-full mr-3"
          v-model="filter"
          :placeholder="$t('bt.filter')"
          @keyup="updateFilter"
        />
      </div>
      <div class="w-2/6 ml-3 pr-5">
        <Dropdown
          class="w-full"
          v-if="settingType == 'U'"
          v-model="select"
          :placeholder="$t('settings.selectUser')"
        />
      </div>
    </div>

    <div class="flex">
      <div class="nci-setting_menu">
        <Tree
          :value="filteredSettingsPaths"
          selectionMode="single"
          v-model:selectionKeys="selectedKey"
          :metaKeySelection="false"
          @nodeSelect="updateKey"
          @nodeUnselect="updateKey"
          :expandedKeys="expandedKeys"
        ></Tree>
      </div>
      <div class="w-3/6 ml-5">
        <div
          class="nci-setting_item"
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
import InputText from "primevue/inputtext";
import Tree from "primevue/tree";
import Dropdown from 'primevue/dropdown';

export default {
  components: {
    Dropdown,
    InputText,
    NciSettings,
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
      selectedKey: null,
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

    updateKey(node){
      this.useSettingsStore.setKey(node.key);
    },
  },
};
</script>
