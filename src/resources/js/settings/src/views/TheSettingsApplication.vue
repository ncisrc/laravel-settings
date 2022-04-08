<template>
  <div>
    Hello Application
    <nci-input
      :value="search"
      type="text"
      placeholder="search"
      @update:value="updateSearch"
    />
    <nci-settings-tree
    :pathItems="pathItemsFiltered"
    @select:key="displayParams"/>
  </div>
</template>

<script>
import { NciInput } from "@/components/ui/NciUI";

import {
  NciSettingsInput,
  NciSettingsTree,
  NciSettingsSelect,
  NciSettingsSwitch,
} from "@/components/NciSettings";
import { NInput } from "naive-ui";
import { mapState } from "pinia";
import { useSettings } from "@/business/stores/useSettings";

export default {
  components: {
    NInput,
    NciInput,
    NciSettingsInput,
    NciSettingsTree,
    NciSettingsSelect,
    NciSettingsSwitch,
  },

  computed: {
    ...mapState(useSettings, { pathItems: "settingsPath", loadParams: "listParams" }),

    pathItemsFiltered() {
      // console.log(this.pathItems);
      // return this.pathItems.filter((item) => {
      //   if (item.key.toLowerCase().includes(this.search.toLowerCase())) {
      //     console.log("item " + item.key);
      //     return item;
      //   }

      //   if (item.children) {
      //     for (let i = 0; i < item.children.length; i++) {
      //       console.log("fah", item.children[i].key);
      //       //     if (
      //       //       item.children[i].key
      //       //         .toLowerCase()
      //       //         .includes(this.search.toLowerCase())
      //       //     ) {
      //       //       console.log("testfah " + item.children[i].key);
      //       //       // return item.children[i];
      //       //       return { key: "groupe1.sousgroupe1", label: "i18n-groupe1.sousgroupe1"}
      //       //     }
      //     }
      //   }
      // });
      let toto = [];
      for (let i = 0; i < this.pathItems.length; i++) {
        if (
          this.pathItems[i].key
            .toLowerCase()
            .includes(this.search.toLowerCase())
        ) {
          // console.log(this.pathItems[i].key);
          toto.push(this.pathItems[i]);
        }

        if (this.pathItems[i].children)
          for (let j = 0; j < this.pathItems[i].children.length; j++) {
            if (
              this.pathItems[i].children[j].key
                .toLowerCase()
                .includes(this.search.toLowerCase()) &&
              !this.pathItems[i].key
                .toLowerCase()
                .includes(this.search.toLowerCase())
            ) {
              // console.log(this.pathItems[i].children[j].key);
              toto.push(this.pathItems[i].children[j]);
            }
          }
      }
      // console.log("testfah", toto);
      return toto;
    },
  },

  methods: {
    updateSearch(text) {
      this.search = text;
    },
    displayParams(key) {
      this.loadParams(key);
    }
  },

  data() {
    return {
      search: "",
    };
  },
};
</script>
