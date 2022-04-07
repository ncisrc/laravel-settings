<template>
  <n-tree
    block-line
    :data="settingsManager.get()"
    :default-expanded-keys="defaultExpandedKeys"
    selectable
  />
</template>

<script>
import { NTree } from "naive-ui";

export default {
  components: {
    NTree,
  },

  data() {
    return {
      defaultExpandedKeys: [],
    };
  },
};
</script>
