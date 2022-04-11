<template>
  <div class="main">
    <nci-tabs type="line" animated>
      <template #settingsApplication>
        <the-settings-application />
      </template>
      <template #settingsUsers>
        <the-settings-users />
      </template>
    </nci-tabs>
  </div>
</template>

<script>
import { NciTabs } from "@/components/ui/NciUI";
import TheSettingsApplication from "./views/TheSettingsApplication.vue";
import TheSettingsUsers from "./views/TheSettingsUsers.vue";

import { mapActions } from 'pinia';
import { useSettings } from '@/business/stores/useSettings'

import MockPersistanceLayer from './mocks/MockPersistanceLayer';
const persistanceLayer = new MockPersistanceLayer();

export default {
  components: {
    NciTabs,
    TheSettingsApplication,
    TheSettingsUsers,
  },

  mounted() {
    this.refresh();
  },

  methods: {
    ...mapActions(useSettings, {settingsStoreLoad: 'load'}),

    refresh() {
      this.settingsStoreLoad(persistanceLayer);
    },
  },
};
</script>

<style lang="scss" scoped>
.main {
    margin: 8rem;
}

</style>