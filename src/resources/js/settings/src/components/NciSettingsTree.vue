<template>
  <div>
    <n-tree
      block-line
      :data="toto"
      :default-expanded-keys="defaultExpandedKeys"
      selectable
      @update:selected-keys="handleClick"
    />
  </div>
</template>

<script>
import { NTree } from "naive-ui";

export default {
  components: {
    NTree,
  },

  props: {
    toto: Object
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
