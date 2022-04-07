<template>
  <div>
    <n-tabs type="line" animated>
      <n-tab-pane name="application" tab="application">
        <the-settings-application />
      </n-tab-pane>
      <n-tab-pane name="users" tab="users">
        <the-settings-users />
      </n-tab-pane>
    </n-tabs>
  </div>
</template>

<script>
import TheSettingsApplication from "./views/TheSettingsApplication.vue";
import TheSettingsUsers from "./views/TheSettingsUsers.vue";
import { NTabs, NTabPane } from "naive-ui";

import { useSettings } from '@/business/stores/useSettings'
import MockPersistanceLayer from './mocks/MockPersistanceLayer';
import { mapActions } from 'pinia';
const persistanceLayer = new MockPersistanceLayer();

export default {
  components: {
    NTabPane,
    NTabs,
    TheSettingsApplication,
    TheSettingsUsers,
  },


  mounted() {
    this.refresh();
  },

  data() {
    return {};
  },

  methods: {
    ...mapActions(useSettings, ['load']),

    refresh() {
      this.load(persistanceLayer);
    }
  }
};
</script>

<style >
@import "./App.scss";
</style>