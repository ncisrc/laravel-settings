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
  emits: ["select:key"],
  methods: {
    handleClick(label) {
      this.$emit("select:key", label)
    },
  },
  data() {
    return {
      defaultExpandedKeys: [],
    };
  },
};

</script>
