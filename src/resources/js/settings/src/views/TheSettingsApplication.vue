<template>
  <div>
    Hello Application

    <nci-input v-model:value="search" type="text" placeholder="search" />
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
import {
  NciInput
} from "@/components/ui/NciUI";

import {
  NciSettingsInput,
  NciSettingsTree,
  NciSettingsSelect,
  NciSettingsSwitch,
} from "@/components/NciSettings";

export default {
  components: {
    NciInput,
    NciSettingsInput,
    NciSettingsTree,
    NciSettingsSelect,
    NciSettingsSwitch,
  },

  data() {
    return {
      search: "",
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
