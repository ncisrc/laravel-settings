<template>
  <n-tree
    block-line
    :data="rawData"
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

  props:{
    rawData : Object,
  },

  data() {
    return {
      defaultExpandedKeys: [],
    };
  },
};
</script>
