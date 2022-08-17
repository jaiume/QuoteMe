// eslint-disable-next-line no-undef
Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'supplier-profile',
      path: '/supplier-profile',
      component: require('./components/Tool'),
    },
  ]);
});
