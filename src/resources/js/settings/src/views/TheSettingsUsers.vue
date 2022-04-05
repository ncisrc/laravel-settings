<template>
  <div>
    <n-input v-model:value="search" type="text" placeholder="search" />
    <n-select v-model:value="select" placeholder="Choix de l'utilisateur" />
    <n-tree
      block-line
      :data="data"
      :default-expanded-keys="defaultExpandedKeys"
      selectable
    />
  </div>
</template>

<script>
import { NInput, NSelect, NTree } from "naive-ui";
import { repeat } from "seemly";

export default {
  components: {
    NInput,
    NSelect,
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
      if (level === 2) return "Out of Two, Three";
      if (level === 1) return "Out of Three, the created universe";
      return "";
    },
  },
};
</script>
