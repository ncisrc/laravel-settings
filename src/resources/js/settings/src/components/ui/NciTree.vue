<template>
  <div>
    <n-tree
      block-line
      :data="settingsManager.get()"
      :default-expanded-keys="defaultExpandedKeys"
      selectable
    />
  </div>
</template>

<script>
import { NTree } from "naive-ui";
import SettingsManager from "../../business/SettingsManager";
import MockPersistanceLayer from "../../mocks/MockPersistanceLayer";

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
    //
  },
};
</script>
