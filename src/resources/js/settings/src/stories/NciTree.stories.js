import MyNciTree from '../components/ui/NciTree';

export default {
  title: 'NciSettingsList/MyNciTree',
  component: MyNciTree,
};

const Template = (args) => ({
  // Components used in your story `template` are defined in the `components` object
  components: { MyNciTree },
  // The story's `args` need to be mapped into the template through the `setup()` method
  setup() {
    // Story args can be spread into the returned object
    return { ...args };
  },
  // Then, the spread values can be accessed directly in the template
  template: '<my-nci-tree />',
});

export const NciTree = Template.bind({});
NciTree.args = {
  search: "",
};
