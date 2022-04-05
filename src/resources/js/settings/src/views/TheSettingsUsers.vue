<template>
  <div>
    <n-input v-model:value="search" type="text" placeholder="search" />
    <n-select v-model:value="select" placeholder="Choix de l'utilisateur" />
    <nci-settings-tree/>
  </div>
</template>

<script>
import { NInput, NSelect, NTree } from "naive-ui";
import NciSettingsTree from '../components/NciSettingsTree.vue';

export default {
  components: {
    NInput,
    NSelect,
    NTree,
    NciSettingsTree,
  },

  data() {
    return {
      search: "",
      select: null,
    };
  },
};
</script>
