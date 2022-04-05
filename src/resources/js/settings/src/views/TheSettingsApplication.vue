<template>
  <div>
    <n-input v-model:value="search" type="text" placeholder="search" />
    <nci-settings-tree/>
  </div>
</template>

<script>
import { NInput, NTree } from "naive-ui";
import NciSettingsTree from '../components/NciSettingsTree.vue';

export default {
  components: {
    NInput,
    NTree,
    NciSettingsTree,
  },

  data() {
    return {
      search: "",
    };
  },
};
</script>
