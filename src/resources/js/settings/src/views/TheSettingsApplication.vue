<template>
  <div>
    Hello Application
    <nci-input :value="search" type="text" placeholder="search" @update:value="test"/> 
    <nci-settings-tree :pathItems="pathItemsFiltered" />
    <nci-settings-input :setting="setting" />
    <nci-settings-switch :setting="setting" />
    <nci-settings-select
      :setting="setting"
      :multiple="true"
      :filterable="true"
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
import {NInput} from "naive-ui"
import { mapState } from 'pinia';
import { useSettings } from '@/business/stores/useSettings'

export default {
  components: {
    NInput,
    NciInput,
    NciSettingsInput,
    NciSettingsTree,
    NciSettingsSelect,
    NciSettingsSwitch,
  },

  computed: {
    ...mapState(useSettings, {pathItems: 'settingsPath'}),

    pathItemsFiltered() {
      console.log(this.pathItems);
      return this.pathItems.filter((item) => {
       if (item.key.toLowerCase().includes(this.search.toLowerCase())){
           return item;
       }
      })
    }
  },

  methods:{
    test(text){
      this.search=text;
    }
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
