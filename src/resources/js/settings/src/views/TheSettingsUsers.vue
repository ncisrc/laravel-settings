<template>
  <div>
    <n-input v-model:value="search" type="text" placeholder="search" />
    <n-select v-model:value="select" placeholder="Choix de l'utilisateur" />
    <nci-settings-tree/>
    <nci-settings-select :options="options" :multipleSelect="false"/>
  </div>
</template>

<script>
import { NInput, NSelect, NTree } from "naive-ui";
import NciSettingsTree from '../components/NciSettingsTree.vue';
import NciSettingsSelect from '../components/NciSettingsSelect.vue';

export default {
  components: {
    NInput,
    NSelect,
    NTree,
    NciSettingsTree,
    NciSettingsSelect,
  },

  data() {
    return {
      search: "",
      select: null,

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
    };
  },
};
</script>
