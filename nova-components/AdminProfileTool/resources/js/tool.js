// eslint-disable-next-line no-undef
Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'admin-profile',
      path: '/admin-profile',
      component: require('./components/Tool'),
    },
  ]);
});
