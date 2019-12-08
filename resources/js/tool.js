Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'bilty-services',
            path: '/bilty-services',
            component: require('./components/Tool'),
        },
    ])
})
