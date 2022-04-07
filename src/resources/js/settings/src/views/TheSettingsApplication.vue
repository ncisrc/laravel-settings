<template>
  <div>
    <n-input v-model:value="search" type="text" placeholder="search" />
    <nci-settings-tree />

    <nci-settings-input :setting="setting" />
    <nci-settings-switch :setting="setting" />
    <nci-settings-select
      :setting="setting"
      :multiple="true"
      :filterable="true"
    />
    <nci-settings-select
      :setting="setting"
      :multiple="false"
      :filterable="true"
    />
    <nci-settings-select
      :setting="setting"
      :multiple="false"
      :filterable="false"
    />
    <nci-settings-select
      :setting="setting"
      :multiple="true"
      :filterable="false"
    />
  </div>
</template>

<script>
import { NInput, NTree } from "naive-ui";
import NciSettingsInput from "../components/NciSettingsInput.vue";
import NciSettingsTree from "../components/NciSettingsTree.vue";
import NciSettingsSelect from "../components/NciSettingsSelect.vue";
import NciSettingsSwitch from "../components/NciSettingsSwitch.vue";
import settingsManager from "../business/SettingsManager";

export default {
  components: {
    NInput,
    NTree,
    NciSettingsInput,
    NciSettingsTree,
    NciSettingsSelect,
    NciSettingsSwitch,
  },

  beforeRouteEnter(to, from, next) {
    next(async (vm) => {
      vm.settingsManager.loadAll();
    })
  },

  data() {
    return {
      search: "",
      settingsManager,
      setting: {
        title: "coucou",
        path: "10",
        description: "hello",
        options: [
          {
            label: "toto",
            value: "toto",
          },
          {
            label: "tata",
            value: "tata",
          },
          {
            label: "titi",
            value: "titi",
          },
        ],
      },
    };
  },
};
</script>
