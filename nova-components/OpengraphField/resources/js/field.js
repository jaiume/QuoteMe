Nova.booting((Vue, router, store) => {
  Vue.component('index-opengraph-field', require('./components/IndexField'))
  Vue.component('detail-opengraph-field', require('./components/DetailField'))
  Vue.component('form-opengraph-field', require('./components/FormField'))
})
