<template>
  <div>
    <n-tree
      block-line
      :data="data"
      :default-expanded-keys="defaultExpandedKeys"
      selectable
    />
  </div>
</template>

<script>
import { NTree } from "naive-ui";
import { repeat } from "seemly";

export default {
  components: {
    NTree,
  },

  data() {
    return {
      search: "",
      select: null,
      data: this.createData(),
      defaultExpandedKeys: [],
    };
  },

  methods: {
    createData(level = 2, baseKey = "") {
      if (!level) return void 0;
      return repeat(3 - level, void 0).map((_, index) => {
        const key = "" + baseKey + level + index;
        return {
          label: this.createLabel(level),
          key,
          children: this.createData(level - 1, key),
        };
      });
    },

    createLabel(level) {
      if (level === 2) return "terminal";
      if (level === 1) return "integrated";
      return "";
    },
  },
};
</script>
