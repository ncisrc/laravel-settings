<template>
    <n-tree
      block-line
      :data="pathItems"
      :default-expanded-keys="defaultExpandedKeys"
      selectable
      @update:selected-keys="handleClick"
    />
</template>

<script>
import { NTree } from "naive-ui";

export default {
  components: {
    NTree,
  },

  props: {
    pathItems: Object
  },

  data() {
    return {
      defaultExpandedKeys: [],
    };
  },

  methods: {
    handleClick(label) {
      console.log("handleClick", label);
    },
  },
};

</script>
