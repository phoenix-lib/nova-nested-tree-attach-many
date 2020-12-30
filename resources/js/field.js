Nova.booting((Vue, router, store) => {
  Vue.component('form-nova-nested-tree-attach-many', require('./components/FormField'))
  Vue.component('detail-nova-nested-tree-attach-many', require('./components/DetailField'))
})
