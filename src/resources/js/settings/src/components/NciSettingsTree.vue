<template>
  <div>
    <n-tree
      block-line
      :data="settingsManager.get()"
      :default-expanded-keys="defaultExpandedKeys"
      selectable
      :node-props="nodeProps"
    />
  </div>
</template>

<script>
import { NTree } from "naive-ui";
import SettingsManager from "../business/SettingsManager";
import MockPersistanceLayer from "../mocks/MockPersistanceLayer";

export default {
  components: {
    NTree,
  },

  mounted() {
    this.settingsManager.loadAll();
  },

  data() {
    return {
      search: "",
      select: null,
      settingsManager: new SettingsManager(new MockPersistanceLayer()),
      defaultExpandedKeys: [],
    };
  },

  methods: {
    nodeProps: ({ option }) => {
      return {
        onClick(){
          console.log('1 :' + option.label);
          console.log('2 :' + this.settingsManager);
          console.log('3 :' + this.settingsManager.load(option.label));
        },
      };
    },
  },
};
</script>
