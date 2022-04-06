import MyNciSettingsTree from '../components/NciSettingsTree';

export default {
  title: 'NciSettingsList/MyNciSettingsTree',
  component: MyNciSettingsTree,
};

const Template = (args) => ({
  // Components used in your story `template` are defined in the `components` object
  components: { MyNciSettingsTree },
  // The story's `args` need to be mapped into the template through the `setup()` method
  setup() {
    // Story args can be spread into the returned object
    return { ...args };
  },
  // Then, the spread values can be accessed directly in the template
  template: '<my-nci-settings-tree />',
});

export const NciSettingsTree = Template.bind({});
NciSettingsTree.args = {
  search: "",
};
